<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp\Slack\Channel;

use Amp\Promise;
use Slamp\Slack\User;
use Slamp\SlackObjectMethods;

/**
 * AbstractChannelsMethods
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
abstract class AbstractChannelsMethods extends SlackObjectMethods
{
    /**
     * Archives a channel or group.
     * @see https://api.slack.com/methods/(channels|groups).archive
     *
     * @param string|AbstractChannel $channel Channel/group to archive.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function archiveAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'archive', $options);
    }

    /**
     * Creates a channel or group.
     * @see https://api.slack.com/methods/(channels|groups).create
     *
     * @param string $channelName Name of channel/group to create.
     * @param array  $options     Method optional arguments.
     *
     * @return Promise<AbstractChannel>
     */
    public function createAsync(string $channelName, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult(null, 'create', $options + ['name' => $channelName]);
    }

    /**
     * Gets information about a team channel or group.
     * @see https://api.slack.com/methods/(channels|groups).info
     *
     * @param string|AbstractChannel $channel Channel/group to get info on.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<AbstractChannel>
     */
    public function infoAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($channel, 'info', $options);
    }

    /**
     * Invites a user to a channel or group. The calling user must be a member of that channel.
     * @see https://api.slack.com/methods/(channels|groups).invite
     *
     * @param string|AbstractChannel $channel Channel/group to invite user to.
     * @param string|User            $user    User to invite to channel.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<AbstractChannel>
     */
    public function inviteAsync($channel, $user, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($channel, 'invite', $options + ['user' => $user]);
    }

    /**
     * Kicks an user from a channel or group.
     * @see https://api.slack.com/methods/(channels|groups).kick
     *
     * @param string|AbstractChannel $channel Channel/group to remove user from.
     * @param string|User            $user    User to remove from channel.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function kickAsync($channel, $user, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'kick', $options + ['user' => $user]);
    }

    /**
     * Leaves a channel or group.
     * @see https://api.slack.com/methods/(channels|groups).leave
     *
     * @param string|AbstractChannel $channel Channel/group to leave.
     * @param array                  $options Method optional arguments.
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
     * FOR CHANNELS: Gets a list of all channels in the team. This includes channels the caller is in, channels
     * they are not currently in, and archived channels but does not include private channels.
     *
     * FOR GROUPS: Gets a list of private channels in the team that the caller is in and archived groups that
     * the caller was in. For compatibility with older clients, this also returns MPIMs. You can check if a group
     * is an MPIM by calling $group->isMpim().
     *
     * The number of (non-deactivated) members in each channel is also returned.
     * @see https://api.slack.com/methods/(channels|groups).list
     *
     * @param array $options Method optional arguments:
     *                        - [bool exclude_archived = false] Don't return archived channels/groups.
     *
     * @return Promise<AbstractChannel[]>
     */
    public function listAsync(array $options = []) : Promise
    {
        return $this->callMethodWithCollectionResult(null, 'list', $options);
    }

    /**
     * Renames a team channel or group.
     * @see https://api.slack.com/methods/(channels|groups).rename
     *
     * @param string|AbstractChannel $channel Channel/group to rename.
     * @param string                 $name    New name for channel/group.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function renameAsync($channel, string $name, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'rename', $options + ['name' => $name]);
    }

    /**
     * Changes the purpose of a channel or group.
     * The calling user must be a member of the channel or group.
     * @see https://api.slack.com/methods/(channels|groups).setPurpose
     *
     * @param string|AbstractChannel $channel Channel/group to set the purpose of
     * @param string                 $purpose New purpose for channel/group.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function setPurposeAsync($channel, string $purpose, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'setPurpose', $options + ['purpose' => $purpose]);
    }

    /**
     * Changes the topic of a channel or group.
     * The calling user must be a member of the channel or group.
     * @see https://api.slack.com/methods/(channels|groups).setTopic
     *
     * @param string|AbstractChannel $channel Channel/group to set the topic of
     * @param string                 $topic   New topic for channel/group.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function setTopicAsync($channel, string $topic, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'setTopic', $options + ['topic' => $topic]);
    }

    /**
     * Unarchives a channel or group.
     * @see https://api.slack.com/methods/(channels|groups).unarchive
     *
     * @param string|AbstractChannel $channel Channel/group to unarchive.
     * @param array                  $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function unarchiveAsync($channel, array $options = []) : Promise
    {
        return $this->callMethodAsync($channel, 'unarchive', $options);
    }
}