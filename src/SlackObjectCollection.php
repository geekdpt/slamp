<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp;

/**
 * SlackObjectCollection
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
abstract class SlackObjectCollection extends SlackObjectAware
{
    /**
     * SlackObjectCollection constructor.
     *
     * @param WebClient $webClient
     */
    final public function __construct(WebClient $webClient)
    {
        $this->webClient = $webClient;
    }
}
