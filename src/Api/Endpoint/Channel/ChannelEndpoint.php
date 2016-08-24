<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 16:03
 */

namespace Slamp\Api\Endpoint\Channel;


use Amp\Promise;
use Slamp\Api\Endpoint\Channel\SlackObjects\Channel;
use Slamp\Api\Endpoint;
use Slamp\WebClient;

class ChannelEndpoint extends Endpoint
{
    /** @var string */
    protected $channel;

    /**
     * UserEndpoint constructor.
     *
     * @param WebClient $webClient
     * @param string    $channel
     */
    public function __construct(WebClient $webClient, string $channel)
    {
        $this->channel = $channel;

        parent::__construct($webClient);
    }

    public function configure() : array
    {
        return [
            'slackObjectClass' => Channel::class,
            'apiPrefix'        => 'channels',
            'apiName'          => 'channel',
            'apiNamePlural'    => 'channels',
        ];
    }


    /**
     * Gets a channel by ID.
     * @link https://api.slack.com/methods/channels.info
     *
     * @return Promise<Channel>
     */
    public function getAsync() : Promise
    {
        return $this->callMethodWithObjectResultAsync('info', ['channel' => $this->channel]);
    }

    /**
     * Archives a channel.
     * @link https://api.slack.com/methods/channels.archive
     *
     *
     * @return Promise
     */
    public function archiveAsync() : Promise
    {
        return $this->callMethodAsync('archive', $this->channel);
    }

    /**
     * Unarchives a channel.
     * @link https://api.slack.com/methods/channels.unarchive
     *
     * @return Promise
     */
    public function unarchiveAsync() : Promise
    {
        return $this->callMethodAsync('unarchive', $this->channel);
    }

}