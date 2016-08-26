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

use Amp\{Promise, function pipe};
use Slamp\SlackObjectCollection;

/**
 * ChannelsCollection
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class ChannelCollection extends SlackObjectCollection
{
    use ChannelTypeTrait;

    public function listAsync() : Promise
    {
        return $this->callMethodWithCollectionResult(null, 'list');
    }
}