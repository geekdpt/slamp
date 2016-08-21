<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp\Exception;

/**
 * SlackException
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class SlackException extends \Exception
{
    protected $slackCode;


    final public static function fromSlackCode(string $slackCode) : SlackException
    {
        # We CamelCasify the slack code and check if there's an exception class for that.
        # Otherwise, we'll use this class.
        $neededClass = __NAMESPACE__.'\\'.implode('', array_map('ucfirst', explode('_', $slackCode))).'Exception';
        $class = class_exists($neededClass) ? $neededClass : self::class;

        return new $class($slackCode);
    }

    public function __construct(string $slackCode)
    {
        $this->slackCode = $slackCode;

        if(self::class == static::class) {
            $this->message = ucfirst(str_replace('_', ' ', $slackCode));
        }
    }

    public function getSlackCode() : string
    {
        return $this->slackCode;
    }
}