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
use Slamp\SlackObject;

/**
 * Channel object.
 * @see https://api.slack.com/types/channel
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class Channel extends SlackObject
{
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
     * @see ChannelsMethods::archiveAsync()
     *
     * @return Promise
     */
    public function archiveAsync() : Promise
    {
        return $this->webClient->channels->archiveAsync($this);
    }

    /**
     * @see ChannelsMethods::unarchiveAsync()
     *
     * @return Promise
     */
    public function unarchiveAsync() : Promise
    {
        return $this->webClient->channels->unarchiveAsync($this);
    }

    /**
     * @see ChannelsMethods::inviteAsync()
     *
     * @param string|User $user
     *
     * @return Promise
     */
    public function inviteAsync($user) : Promise
    {
        return $this->webClient->channels->inviteAsync($this, $user);
    }

    /**
     * @see ChannelsMethods::joinAsync()
     *
     * @return Promise
     */
    public function joinAsync() : Promise
    {
        return $this->webClient->channels->joinAsync($this);
    }

    /**
     * @see ChannelsMethods::leaveAsync()
     *
     * @return Promise
     */
    public function leaveAsync() : Promise
    {
        return $this->webClient->channels->leaveAsync($this);
    }

    /**
     * @see ChannelsMethods::kickAsync()
     *
     * @param string|User $user
     *
     * @return Promise
     */
    public function kickAsync($user) : Promise
    {
        return $this->webClient->channels->kickAsync($this, $user);
    }

    /**
     * @see ChannelsMethods::renameAsync()
     *
     * @param string $name
     *
     * @return Promise<string>
     */
    public function renameAsync(string $name) : Promise
    {
        return $this->webClient->channels->renameAsync($this, $name);
    }

    /**
     * @see ChannelsMethods::setPurposeAsync()
     *
     * @param string $purpose
     *
     * @return Promise
     */
    public function setPurposeAsync(string $purpose) : Promise
    {
        return $this->webClient->channels->setPurposeAsync($this, $purpose);
    }

    /**
     * @see ChannelsMethods::setTopicAsync()
     *
     * @param string $topic
     *
     * @return Promise
     */
    public function setTopicAsync(string $topic) : Promise
    {
        return $this->webClient->channels->setTopicAsync($this, $topic);
    }
}
