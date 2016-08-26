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

use Amp\Artax;

/**
 * Returns a WebClient instance.
 *
 * @param string|null       $token      Slack API token. If you don't set one at construct time, you can set it up
 *                                      later with self::setToken(), or change it on-the-fly to use another team/bot.
 * @param Artax\Client|null $httpClient An Artax client instance, auto-created if not given.
 *
 * @return WebClient
 */
function webClient(string $token, Artax\Client $httpClient = null) : WebClient
{
    return new WebClient($token, $httpClient);
}
