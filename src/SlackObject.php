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
abstract class SlackObject implements \ArrayAccess, \JsonSerializable
{
    /** @var WebClient */
    protected $webClient;

    /** @var array */
    protected $data;

    /**
     * Factory for instantiating a SlackObject from an associative array representing it.
     *
     * @param WebClient $webClient An instance of the web client
     * @param array     $data      The SlackObject's contents
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
     * Gets Slackobject's unique identifier.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->data['id'];
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
            throw new \DomainException("Unknown property {$offset}.");
        }

        return $this->data[$offset];
    }

    /**
     * This method must not be used as SlackObjects are read-only.
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws \LogicException if accessed
     */
    public function offsetSet($offset, $value)
    {
        throw self::getReadOnlyException();
    }

    /**
     * This method must not be used as SlackObjects are read-only.
     *
     * @param mixed $offset
     *
     * @throws \LogicException if accessed
     */
    public function offsetUnset($offset)
    {
        throw self::getReadOnlyException();
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

    /**
     * @return string
     */
    public function __toString() : string
    {
        $class = static::class;
        $json = json_encode($this, JSON_PRETTY_PRINT);

        return "SlackObject({$class}) {$json}";
    }

    /**
     * @return \LogicException
     */
    private static function getReadOnlyException() : \LogicException
    {
        return new \LogicException('SlackObjects are read-only.');
    }
}
