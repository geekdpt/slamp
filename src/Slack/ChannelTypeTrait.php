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

/**
 * ChannelDescriptionTrait
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
trait ChannelTypeTrait
{
    protected static function getApiTypeDescription() : array
    {
        return [
            'slackObjectClass' => Channel::class,
            'endpointPrefix' => 'channels',
            'methodItemName' => 'channel',
            'methodCollectionName' => 'channels'
        ];
    }
}