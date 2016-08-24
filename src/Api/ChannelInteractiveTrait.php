<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 14:39
 */

namespace Slamp\Api;


trait ChannelInteractiveTrait
{

    public function from(string $from)
    {
        if (!isset($this->payload)) {
            $this->payload = [];
        }
        $this->payload['username'] = $from;

        return $this;
    }

    public function to(string $channel)
    {
        if (!isset($this->payload)) {
            $this->payload = [];
        }
        $this->payload['channel'] = $channel;

        return $this;
    }
}