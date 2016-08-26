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
use Slamp\{Generic, SlackObject};

/**
 * Channel
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class Channel extends SlackObject implements Generic\LoadableSlackObjectInterface
{
    use ChannelTypeTrait;

    /** {@inheritdoc} */
    public function loadAsync() : Promise
    {
        return $this->callMethodWithObjectResult($this, 'info');
    }
}