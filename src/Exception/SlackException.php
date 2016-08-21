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
        # We CamelCasify the slack code and check if there's an exception subclass for that.
        # Otherwise, fallback to this class (when this happens, it means that Slamp is outdated).
        $neededClass = __NAMESPACE__.'\\'.implode('', array_map('ucfirst', explode('_', $slackCode))).'Exception';
        $class = class_exists($neededClass) ? $neededClass : self::class;

        return new $class($slackCode);
    }

    public function __construct(string $slackCode)
    {
        $this->slackCode = $slackCode;

        # If the instance being created is not a subclass with a real message, transform the error code into a phrase.
        if(self::class == static::class) {
            $this->message = ucfirst(str_replace('_', ' ', $slackCode));
        }
    }

    public function getSlackCode() : string
    {
        return $this->slackCode;
    }
}