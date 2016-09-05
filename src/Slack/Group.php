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
 * Group object.
 * @see https://api.slack.com/types/group
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class Group extends Channel\AbstractChannel
{
    /** {@inheritdoc} */
    protected function getChannelMethods() : Channel\AbstractChannelsMethods
    {
        return $this->webClient->groups;
    }

    /**
     * Gets whether a multiparty im (mpim) is being emulated as a group or if that group is a real group.
     *
     * @return bool
     */
    public function isMpim() : bool
    {
        return $this['is_mpim'];
    }

    /**
     * @see GroupsMethods::closeAsync()
     *
     * @return Promise
     */
    public function closeAsync() : Promise
    {
        return $this->webClient->groups->closeAsync($this);
    }

    /**
     * @see GroupsMethods::createChildAsync()
     *
     * @return Promise
     */
    public function createChildAsync() : Promise
    {
        return $this->webClient->groups->createChildAsync($this);
    }
}