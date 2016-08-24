<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 11:24
 */

namespace Slamp\Api;


use Amp\Deferred;
use Amp\Promise;
use Slamp\WebClient;

abstract class Endpoint implements EndpointInterface
{
    /** @var string Slack Object FQDN */
    public $slackObjectClass;

    /** @var string API methods prefix */
    public $apiPrefix;

    /** @var string In the API, object types are referred by a lowercase name */
    public $apiName;

    /** @var string Same as $apiName, pluralized (collections) */
    public $apiNamePlural;

    /** @var  array */
    public $payload = [];

    /** @var WebClient */
    protected $webClient;

    /** @var callable */
    private $nopTransformer;

    public function __construct(WebClient $webClient)
    {
        $this->webClient = $webClient;
        $this->nopTransformer = function ($data) {
            return $data;
        };

        $conf = $this->configure();
        foreach (['slackObjectClass', 'apiPrefix', 'apiName', 'apiNamePlural'] as $requiredProp) {
            if (!array_key_exists($requiredProp, $conf)) {
                throw new \LogicException("Missing ${requiredProp} configuration property");
            } else {
                $this->$requiredProp = $conf[$requiredProp];
            }
        }
    }

    abstract protected function configure() : array;

    /**
     * @return WebClient
     */
    public function getWebClient(): WebClient
    {
        return $this->webClient;
    }

    final protected function callMethodWithObjectResultAsync(
        string $method,
        array $arguments = [],
        callable $transformer = null
    ) : Promise
    {
        return $this->apiCallToSlackObjectAsync(
            $this->callMethodAsync($method, null, $arguments, $transformer ?: $this->nopTransformer),
            false, $this->slackObjectClass, $this->apiName
        );
    }

    final protected function apiCallToSlackObjectAsync(
        Promise $futureResponse,
        bool $isCollection,
        string $class,
        string $property
    ) : Promise
    {
        /** @var SlackObject $class */
        $promisor = new Deferred;
        $futureResponse->when(
            function (\Throwable $err = null, array $response = null) use (
                $isCollection,
                $class,
                $property,
                $promisor
            ) {
                try {
                    if ($err) {
                        throw $err;
                    }

                    $data = $property ? $response[$property] : $response;
                    if ($isCollection) {
                        $objects = [];
                        foreach ($data as $rawObject) {
                            $objects[] = $class::fromClientAndArray($this->webClient, $rawObject);
                        }
                        $promisor->succeed($objects);
                    } else {
                        $promisor->succeed($class::fromClientAndArray($this->webClient, $data));
                    }
                } catch (\Throwable $err) {
                    $promisor->fail($err);
                }
            }
        );

        return $promisor->promise();
    }

    final protected function callMethodAsync(
        string $method,
        $slackObject = null,
        array $arguments = [],
        callable $transformer = null
    ) : Promise
    {
        $promisor = new Deferred;
        $slackObject && ($arguments[$this->apiName] = $slackObject);
        $this->webClient->callAsync($this->apiPrefix . '.' . $method, $arguments)->when(
            function (\Throwable $err = null, array $response = null) use ($transformer, $promisor) {
                try {
                    if ($err) {
                        throw $err;
                    }

                    // $transformer() may fail, that's why we use a try block.
                    $promisor->succeed($transformer ? $transformer($response) : null);
                } catch (\Throwable $err) {
                    $promisor->fail($err);
                }
            }
        );

        return $promisor->promise();
    }

    final protected function callMethodWithCollectionResultAsync(
        string $method,
        array $arguments = [],
        callable $transformer = null
    ) : Promise
    {
        return $this->apiCallToSlackObjectAsync(
            $this->callMethodAsync($method, null, $arguments, $transformer ?: $this->nopTransformer),
            true, $this->slackObjectClass, $this->apiNamePlural
        );
    }
}