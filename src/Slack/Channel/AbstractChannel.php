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
use Slamp\SlackObject;

/**
 * AbstractChannel
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
abstract class AbstractChannel extends SlackObject
{
    /**
     * @return AbstractChannelsMethods
     */
    abstract protected function getChannelMethods() : AbstractChannelsMethods;

    /**
     * Gets channel name.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this['name'];
    }

    /**
     * Gets the channel's creation date.
     *
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime
    {
        return (new \DateTime)->setTimestamp($this['created']);
    }

    /**
     * Gets whether the channel is archived or not.
     *
     * @return bool
     */
    public function isArchived() : bool
    {
        return $this['is_archived'];
    }

    /**
     * Gets whether the channel is the "general" channel or not.
     * Some teams may have changed the default name "general", so you should use this instead of a string match.
     *
     * @return bool
     */
    public function isGeneral() : bool
    {
        return $this['is_general'];
    }

    /**
     * Gets whether the connected user is member of that channel
     *
     * @return bool
     */
    public function isMember() : bool
    {
        return $this['is_member'];
    }

    /**
     * Gets the last time the connected user marked the channel.
     *
     * @return \DateTime
     */
    public function getLastReadAt() : \DateTime
    {
        return (new \DateTime)->setTimestamp((int) $this['last_read']);
    }

    /**
     * Gets the number of unread messages the connected user has (posted after the last mark).
     *
     * @return int
     */
    public function getUnreadCount() : int
    {
        return $this['unread_count'] ?? 0;
    }

    /**
     * Gets the number of unread messages the connected user has yet to read that
     * matter to them (this means it excludes things like join/leave messages).
     *
     * @return int
     */
    public function getUnreadCountDisplay() : int
    {
        return $this['unread_count_display'] ?? 0;
    }

    /**
     * Gets the channel topic.
     *
     * @return string
     */
    public function getTopic() : string
    {
        return $this['topic']['value'];
    }

    /**
     * Gets the channel purpose.
     *
     * @return string
     */
    public function getPurpose() : string
    {
        return $this['purpose']['value'];
    }

    /**
     * Gets the number of members in the channel.
     *
     * @return int
     */
    public function getMembersCount() : int
    {
        return count($this['members']);
    }

    /**
     * Gets the user that created the channel.
     *
     * @return Promise<User>
     */
    public function getCreatorAsync() : Promise
    {
        return $this->webClient->users->infoAsync($this['creator']);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::archiveAsync()
     *
     * @return Promise
     */
    public function archiveAsync() : Promise
    {
        return $this->getChannelMethods()->archiveAsync($this);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::unarchiveAsync()
     *
     * @return Promise
     */
    public function unarchiveAsync() : Promise
    {
        return $this->getChannelMethods()->unarchiveAsync($this);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::inviteAsync()
     *
     * @param string|User $user
     *
     * @return Promise
     */
    public function inviteAsync($user) : Promise
    {
        return $this->getChannelMethods()->inviteAsync($this, $user);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::leaveAsync()
     *
     * @return Promise
     */
    public function leaveAsync() : Promise
    {
        return $this->getChannelMethods()->leaveAsync($this);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::kickAsync()
     *
     * @param string|User $user
     *
     * @return Promise
     */
    public function kickAsync($user) : Promise
    {
        return $this->getChannelMethods()->kickAsync($this, $user);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::renameAsync()
     *
     * @param string $name
     *
     * @return Promise<string>
     */
    public function renameAsync(string $name) : Promise
    {
        return $this->getChannelMethods()->renameAsync($this, $name);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::setPurposeAsync()
     *
     * @param string $purpose
     *
     * @return Promise
     */
    public function setPurposeAsync(string $purpose) : Promise
    {
        return $this->getChannelMethods()->setPurposeAsync($this, $purpose);
    }

    /**
     * @see (ChannelsMethods|GroupsMethods)::setTopicAsync()
     *
     * @param string $topic
     *
     * @return Promise
     */
    public function setTopicAsync(string $topic) : Promise
    {
        return $this->getChannelMethods()->setTopicAsync($this, $topic);
    }
}