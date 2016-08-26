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
 * A SlackObject wraps a Slack API response, or an object inside that response.
 *
 * SlackObject's subclasses can provide high-level functions, but this class also guarantees that you will still be
 * able to read raw values from the API, using ArrayAccess (eg. $slackObject['slack_property']) if Slamp does not fit
 * your needs.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
abstract class SlackObject extends SlackObjectAware  implements \ArrayAccess, \JsonSerializable
{
    /** @var array */
    protected $data;

    /**
     * Factory for instantiating SlackObjects from an associative array representing the object.
     *
     * @param WebClient $webClient An instance of the web client
     * @param array     $data      The object's contents
     *
     * @return SlackObject
     */
    public static function create(WebClient $webClient, array $data) : SlackObject
    {
        $object = new static;
        $object->webClient = $webClient;
        $object->data = $data;

        return $object;
    }

    /**
     * Checks if a SlackObject has some raw property.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset) : bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * Gets a raw property on this SLackObject.
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if(!isset($this->data[$offset])) {
            throw new \DomainException("Unknown property ${offset}.");
        }

        return $this->data[$offset];
    }

    /**
     * This method must not be used as SlackObjects are read-only.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        throw new \LogicException('SlackObjects are read-only.');
    }

    /**
     * This method must not be used as SlackObjects are read-only.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        throw new \LogicException('SlackObjects are read-only.');
    }

    /**
     * Returns SlackObject's raw contents.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}