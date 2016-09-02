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
 * UserPresenceReport object.
 * @see https://api.slack.com/docs/presence
 * @see https://api.slack.com/methods/users.getPresence
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class UserPresenceReport extends SlackObject
{
    public const STATE_AWAY = 'away';

    public const STATE_ACTIVE = 'active';

    /**
     * Gets the user this report concerns.
     *
     * @return Promise<User>
     */
    public function getUserAsync() : Promise
    {
        return isset($this['user'])
            ? $this->webClient->users->infoAsync($this['user'])
            : $this->webClient->users->getMeAsync();
    }

    /**
     * Gets the user's overall presence, it will either be "active" or "away".
     * You can use this class' STATE_AWAY and STATE_ACTIVE constants to compare with this value.
     *
     * @return string
     */
    public function getPresenceState() : string
    {
        return $this['presence'];
    }

    /**
     * Gets if the user has a client currently connected to Slack.
     *
     * @return bool
     */
    public function isOnline() : bool
    {
        $this->checkAuthorization();

        return $this['presence'];
    }

    /**
     * Gets if Slack's servers haven't detected any activity from the user in the last 30 minutes.
     *
     * @return bool
     */
    public function hasBeenSetAwayByServer() : bool
    {
        $this->checkAuthorization();

        return $this['auto_away'];
    }

    /**
     * Gets if the user has manually set its presence to "away".
     *
     * @return bool
     */
    public function hasBeenSetAwayManually() : bool
    {
        $this->checkAuthorization();

        return $this['auto_away'];
    }

    /**
     * Gets total number of connections to Slack!
     *
     * @return int
     */
    public function getConnectionsCount() : int
    {
        $this->checkAuthorization();

        return $this['connection_count'];
    }

    /**
     * When a user is online, gets the date of the last activity seen by Slack's servers.
     *
     * @return \DateTime|null Returns null if a user has no connected clients.
     */
    public function getLastActivityAt() : ?\DateTime
    {
        $this->checkAuthorization();

        return isset($this['last_activity'])
            ? (new \DateTime)->setTimestamp($this['last_activity'])
            : null;
    }

    /**
     * Checks that the requesting user can read the requested user's presence informations.
     *
     * @return void
     */
    private function checkAuthorization() : void
    {
        #=> "online" property, and all the other except "presence" are not set when the requesting user is not the requested user.
        if(!isset($this['online'])) {
            throw new \LogicException('You cannot access another method than getPresenceState() when you requested the presence informations for another user than the authed one.');
        }
    }
}