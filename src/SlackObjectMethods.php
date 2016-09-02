<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp;

use Amp\{Promise, function pipe};

/**
 * SlackObjectMethods
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
abstract class SlackObjectMethods
{
    /** @var \Closure */
    protected static $nopTransformer;

    /** @var \Closure */
    protected static $voidTransformer;

    /** @var WebClient */
    protected $webClient;

    /** @var string Supported SlackObject FQDN */
    protected $slackObjectClass;

    /** @var string Methods prefix (eg. "channels") */
    protected $endpointPrefix;

    /** @var string */
    protected $methodItemName;

    /** @var string */
    protected $methodCollectionName;

    /**
     * SlackObjectMethods constructor.
     *
     * @param WebClient $webClient
     */
    public function __construct(WebClient $webClient)
    {
        $this->webClient = $webClient;

        #=> Initialize some static members
        self::$nopTransformer || self::$nopTransformer = function($input) { return $input; };
        self::$voidTransformer || self::$voidTransformer = function($input) { };

        #=> Configure the SlackObjectMethods instance for a specific API type (channels, users...)
        $configuration = static::configureApiType();

        foreach(['slackObjectClass', 'endpointPrefix', 'methodItemName', 'methodCollectionName'] as $requiredProp) {
            if(!array_key_exists($requiredProp, $configuration)) {
                throw new \LogicException("Missing {$requiredProp} configuration property");
            } else {
                $this->$requiredProp = $configuration[$requiredProp];
            }
        }
    }

    /**
     * @return array An associative array with values for slackObjectClass, apiPrefix, apiName, apiNamePlural.
     */
    protected abstract static function configureApiType() : array;

    /**
     * Calls a method, returns void by default.
     *
     * @param string|SlackObject|null $subject     The slackobject to pass in argument, or null
     * @param string                  $method      The method name, without the type prefix (channels.list => list)
     * @param array                   $arguments   Normal method arguments
     * @param \Closure|null           $transformer Transformer to apply on the response
     *
     * @return Promise
     */
    protected function callMethodAsync($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        if($subject) {
            $arguments[$this->methodItemName] = $subject;
        }

        return pipe(
            $this->webClient->callAsync($this->endpointPrefix.'.'.$method, $arguments),
            $transformer ?: self::$voidTransformer
        );
    }

    /**
     * Calls a method, retrieves the SlackObject in the response and returns it.
     *
     * @param string|SlackObject|null $subject     The slackobject to pass in argument, or null
     * @param string                  $method      The method name, without the type prefix (channels.list => list)
     * @param array                   $arguments   Normal method arguments
     * @param \Closure|null           $transformer Transformer to apply on the response
     *
     * @return Promise
     */
    protected function callMethodWithObjectResult($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        return $this->callMethodAsync($subject, $method, $arguments, $transformer ?: function(array $response) {
            $data = $response[$this->methodItemName];

            return $this->hydrateSlackObject($data);
        });
    }

    /**
     * Calls a method, retrieves the collection of SlackObjects in the response and returns it.
     *
     * @param string|SlackObject|null $subject     The slackobject to pass in argument, or null
     * @param string                  $method      The method name, without the type prefix (channels.list => list)
     * @param array                   $arguments   Normal method arguments
     * @param \Closure|null           $transformer Transformer to apply on the response
     *
     * @return Promise
     */
    protected function callMethodWithCollectionResult($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        return $this->callMethodAsync($subject, $method, $arguments, $transformer ?: function(array $response) {
            $rawSlackObjects = $response[$this->methodCollectionName];

            $slackObjects = [];
            foreach($rawSlackObjects as $rawSlackObject) {
                $slackObjects[] = $this->hydrateSlackObject($rawSlackObject);
            }

            return $slackObjects;
        });
    }

    /**
     * Hydrates a SlackObject from an array.
     *
     * @param array $data SlackObject contents
     *
     * @return SlackObject
     */
    protected function hydrateSlackObject(array $data) : SlackObject
    {
        /** @var SlackObject $class */
        $class = $this->slackObjectClass;

        return $class::create($this->webClient, $data);
    }
}
