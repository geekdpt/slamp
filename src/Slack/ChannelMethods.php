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
use Slamp\SlackObjectMethods;

/**
 * ChannelMethods
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class ChannelMethods extends SlackObjectMethods
{
    /** {@inheritdoc} */
    protected static function configureApiType() : array
    {
        return [
            'slackObjectClass' => Channel::class,
            'endpointPrefix' => 'channels',
            'methodItemName' => 'channel',
            'methodCollectionName' => 'channels'
        ];
    }

    /**
     * Gets a list of all channels in the team. This includes channels the caller is in, channels
     * they are not currently in, and archived channels but does not include private channels. The number of
     * (non-deactivated) members in each channel is also returned.
     *
     * @param bool $excludeArchived Whether to return archived channels or not.
     *
     * @return Promise
     */
    public function listAsync(bool $excludeArchived = false) : Promise
    {
        return $this->callMethodWithCollectionResult(null, 'list', [
            'exclude_archived' => $excludeArchived
        ]);
    }
}