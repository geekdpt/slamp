<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp\Generic;

use Amp\Promise;

/**
 * LoadableSlackObjectInterface
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
interface LoadableSlackObjectInterface
{
    public function loadAsync() : Promise;
}