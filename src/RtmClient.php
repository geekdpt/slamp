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

use Amp\{Promise, Websocket, function pipe, function websocket};

/**
 * RtmClient
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class RtmClient extends WebClient implements Websocket
{
    /**
     * Connects to Slack RTM API and start listening and dispatching events.
     *
     * @return Promise
     */
    public function start() : Promise
    {
        return pipe($this->callAsync('rtm.start'), function(array $rtmInfo) {
            $onOpen = \Closure::fromCallable();
            $repeater = new class($this) implements Websocket {
                private $onOpen;
                private $onData;
                private $onClose;

                public function __construct(callable $onOpen, callable $onData, callable $onClose)
                {
                    $this->onOpen = $onOpen;
                    $this->onData = $onData;
                    $this->onClose = $onClose;
                }

                public function onOpen(Websocket\Endpoint $endpoint, array $headers) { call_user_func($this->onOpen, $endpoint, $headers); }
                public function onData(Websocket\Message $message) { call_user_func($this->onOpen, $message); }
                public function onClose(int $code, string $reason) { call_user_func($this->onOpen, $code, $reason); }
            };

            return websocket($repeater, new Websocket\Handshake($rtmInfo['url']));
        });
    }

    private function handleOpen(Websocket\Endpoint $endpoint, array $headers) : RtmClient
    {
        $this->onOpenCallables[] = $callback;

        return $this;
    }

    public function handleClose(int $code, string $reason) : RtmClient
    {
        $this->onCloseCallables[] = $callback;

        return $this;
    }
}