<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp\Slack;

use Amp\Promise;

/**
 * Channels-related methods.
 * The methods of this class reflect Slack's API and are listed alphabetically.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * @TODO Support channels.history once we have Message SlackObject
 * @TODO Support channels.mark once we have Message SlackObject
 */
class ChannelsMethods extends Channel\AbstractChannelsMethods
{
    /** {@inheritdoc} */
    protected static function configureApiType() : array
    {
        return [
            'slackObjectClass'     => Channel::class,
            'endpointPrefix'       => 'channels',
            'methodItemName'       => 'channel',
            'methodCollectionName' => 'channels'
        ];
    }

    /**
     * Joins a channel. If the channel does not exist, it is created.
     * @see https://api.slack.com/methods/channels.join
     *
     * @param string|Channel $channel Channel to join (/!\ name or Channel instance, not an ID).
     * @param array          $options Method optional arguments.
     *
     * @return Promise<Channel>
     */
    public function joinAsync($channel, array $options = []) : Promise
    {
        $channelName = $channel instanceof Channel ? $channel['name'] : $channel;

        return $this->callMethodWithObjectResult(null, 'join', $options + ['name' => $channelName]);
    }
}
