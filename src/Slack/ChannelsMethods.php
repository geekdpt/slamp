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
use Slamp\SlackObjectMethods;

/**
 * Channels-related methods.
 * The methods of this class reflect Slack's API and are listed alphabetically.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * @TODO Support channels.history once we have Message SlackObject
 * @TODO Support channels.mark once we have Message SlackObject
 */
class ChannelsMethods extends SlackObjectMethods
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
     * Archives a channel.
     * @see https://api.slack.com/methods/channels.archive
     *
     * @param string|Channel $channel Channel to archive.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function archiveAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'archive', $options);
    }

    /**
     * Creates a channel.
     * @see https://api.slack.com/methods/channels.create
     *
     * @param string $channelName Name of channel to create.
     * @param array  $options     Method optional arguments.
     *
     * @return Promise<Channel>
     */
    public function createAsync(string $channelName, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult(null, 'create', $options + ['name' => $channelName]);
    }

    /**
     * Gets information about a team channel.
     * @see https://api.slack.com/methods/channels.info
     *
     * @param string|Channel $channel Channel to get info on.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<Channel>
     */
    public function infoAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($channel, 'info', $options);
    }

    /**
     * Invites a user to a channel. The calling user must be a member of the channel.
     * @see https://api.slack.com/methods/channels.invite
     *
     * @param string|Channel $channel Channel to invite user to.
     * @param string|User    $user    User to invite to channel.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<Channel>
     */
    public function inviteAsync($channel, $user, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($channel, 'invite', $options + ['user' => $user]);
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
    }/** @noinspection PhpUndefinedClassInspection */

    /**
     * Kicks an user from a channel.
     * @see https://api.slack.com/methods/channels.kick
     *
     * @param string|Channel $channel Channel to remove user from.
     * @param string|User    $user    User to remove from channel.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function kickAsync($channel, $user, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'kick', $options + ['user' => $user]);
    }

    /**
     * Leaves a channel.
     * @see https://api.slack.com/methods/channels.leave
     *
     * @param string|Channel $channel Channel to leave.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<bool> resolves to false if the user was not in the channel.
     */
    public function leaveAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodAsync(
            $channel, 'leave', $options,
            function(array $response) : bool {
                return !($response['not_in_channel'] ?? false);
            }
        );
    }

    /**
     * Gets a list of all channels in the team. This includes channels the caller is in, channels
     * they are not currently in, and archived channels but does not include private channels. The number of
     * (non-deactivated) members in each channel is also returned.
     * @see https://api.slack.com/methods/channels.list
     *
     * @param array $options Method optional arguments:
     *                        - [bool exclude_archived = false] Don't return archived channels.
     *
     * @return Promise<Channel[]>
     */
    public function listAsync(array $options = []) : Promise
    {
        return $this->callMethodWithCollectionResult(null, 'list', $options);
    }

    /**
     * Renames a team channel.
     * @see https://api.slack.com/methods/channels.rename
     *
     * @param string|Channel $channel Channel to rename.
     * @param string         $name    New name for channel.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function renameAsync($channel, string $name, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'rename', $options + ['name' => $name]);
    }

    /**
     * Changes the purpose of a channel. The calling user must be a member of the channel.
     * @see https://api.slack.com/methods/channels.setPurpose
     *
     * @param string|Channel $channel Channel to set the purpose of
     * @param string         $purpose New purpose for channel.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function setPurposeAsync($channel, string $purpose, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'setPurpose', $options + ['purpose' => $purpose]);
    }

    /**
     * Changes the topic of a channel. The calling user must be a member of the channel.
     * @see https://api.slack.com/methods/channels.setTopic
     *
     * @param string|Channel $channel Channel to set the topic of
     * @param string         $topic   New topic for channel.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function setTopicAsync($channel, string $topic, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'setTopic', $options + ['topic' => $topic]);
    }

    /**
     * Unarchives a channel.
     * @see https://api.slack.com/methods/channels.unarchive
     *
     * @param string|Channel $channel Channel to unarchive.
     * @param array          $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function unarchiveAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'unarchive', $options);
    }
}
