<?php

namespace Slamp\Api;


use Slamp\WebClient;

class SlackObject implements \ArrayAccess, \JsonSerializable
{
    /** @var WebClient */
    protected $webClient;

    protected $data;

    public static function fromClientAndArray(WebClient $webClient, array $data) : SlackObject
    {
        $object = new static;
        $object->webClient = $webClient;
        $object->data = $data;

        return $object;
    }

    public function getId() : string
    {
        return $this->data['id'];
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->data[$offset])) {
            throw new \DomainException("Unknown property ${offset}.");
        }

        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw new \LogicException('SlackObjects are read-only.');
    }

    public function offsetUnset($offset)
    {
        throw new \LogicException('SlackObjects are read-only.');
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

    public function __toString() : string
    {
        return json_encode($this->data);
    }
}