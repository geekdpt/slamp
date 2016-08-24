<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 16:02
 */

namespace Slamp\Api\Endpoint\Channel\SlackObjects;

use Amp\{
    Deferred, Promise, function all
};
use Slamp\Api\SlackObject;


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
     * Gets the user that created the channel.
     *
     * @return Promise<User>
     */
    public function getCreatorAsync() : Promise
    {
        return $this->webClient->users->infoAsync($this['creator']);
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
        return (new \DateTime)->setTimestamp((int)$this['last_read']);
    }

    /**
     * Gets the last message posted in the channel.
     * Be aware that this method always returns null if you get the Channel object from a ChannelMethods::list() call.
     *
     * @return Event\Message|null
     */
    public function getLatestMessage() #: ?Message
    {
        return $this['latest']
            ? Event\Message::fromClientAndArray($this->webClient, $this['latest'])
            : null;
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
}