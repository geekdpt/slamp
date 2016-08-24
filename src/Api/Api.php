<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 10:47
 */

namespace Slamp\Api;


use Slamp\Api\Endpoint\Channel\ChannelEndpoint;
use Slamp\Api\Endpoint\User\UserEndpoint;
use Slamp\WebClient;

class Api
{
    /**
     * @var WebClient
     */
    protected $webClient;


    /**
     * Api constructor.
     *
     * @param WebClient $webClient
     */
    public function __construct(WebClient $webClient)
    {
        $this->webClient = $webClient;
    }

    /**
     * @param string $user
     *
     * @return UserEndpoint
     */
    public function users(string $user)
    {
        return new UserEndpoint($this->webClient, $user);
    }

    /**
     * @param string $channel
     *
     * @return ChannelEndpoint
     */
    public function channels(string $channel)
    {
        return new ChannelEndpoint($this->webClient, $channel);
    }


}