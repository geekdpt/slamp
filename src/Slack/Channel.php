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
 * Channel object.
 * @see https://api.slack.com/types/channel
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class Channel extends Channel\AbstractChannel
{
    /** {@inheritdoc} */
    protected function getChannelMethods() : Channel\AbstractChannelsMethods
    {
        return $this->webClient->channels;
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
}
