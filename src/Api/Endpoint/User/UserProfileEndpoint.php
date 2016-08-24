<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 15:06
 */

namespace Slamp\Api\Endpoint\User;


use Amp\Promise;
use Slamp\Api\Endpoint\User\SlackObjects\Profile;
use Slamp\Api\Endpoint;
use Slamp\WebClient;

class UserProfileEndpoint extends Endpoint
{
    /**
     * @var string
     */
    protected $user;

    /**
     * UserProfileEndpoint constructor.
     *
     * @param WebClient $webClient
     * @param array     $payload
     */
    public function __construct(WebClient $webClient, array $payload = null)
    {
        $this->webClient = $webClient;
        $this->payload = $payload ?? [];

        parent::__construct($webClient);
    }

    public function getAsync() : Promise
    {
        $payload = $this->payload + ['user' => $this->user];

        return $this->callMethodWithObjectResultAsync('get', $payload);
    }

    public function setAsync(array $params) : Promise
    {
        //TODO: implement
    }

    protected function configure() : array
    {
        return [
            'slackObjectClass' => Profile::class,
            'apiPrefix'        => 'users.profile',
            'apiName'          => 'profile',
            'apiNamePlural'    => 'profiles',
        ];
    }
}