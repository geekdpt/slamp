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
use Amp\{Promise, function pipe};
use Slamp\Exception\SlackException;

/**
 * The WebClient is the base entry point of a Slack Web API client.
 * It handles the communication and gathers more high-level methods.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class WebClient
{
    const BASE_URL = 'https://slack.com/api';

    /** @var Artax\Client */
    protected $httpClient;

    /** @var string */
    protected $token;

    /**
     * WebClient constructor.
     *
     * @param string|null       $token      Slack API token. If you don't set one at construct time, you can set it up
     *                                      later with self::setToken(), or change it on-the-fly to use another team/bot.
     * @param Artax\Client|null $httpClient An Artax client instance, auto-created if not given.
     */
    public function __construct(string $token = null, Artax\Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Artax\Client;
        $this->token = $token;
    }

    /**
     * Change the token used to authenticate to the Slack API.
     * You can change it on-the-fly to change from team or the bot without re-creating a Slamp\WebClient instance.
     *
     * @param string $token Slack API token.
     *
     * @return WebClient
     */
    public function setToken(string $token): WebClient
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Performs a call against the API, and returns the response without any transformation.
     * If an error happens, the promise is rejected and you get a Slamp\Exception\SlackException subclass.
     *
     * @param string $method    The API method name (eg. users.info).
     * @param array  $arguments The API method named arguments.
     *
     * @return Promise
     */
    public function callAsync(string $method, array $arguments = []) : Promise
    {
        return pipe($this->doHttpRequestAsync($method, $arguments), function(Artax\Response $response) {
            # Slack _always_ returns JSON objects in its reponses.
            # If we can't decode a JSON object, stop immediately.
            if(!is_array($content = json_decode($response->getBody(), true))) {
                throw new \InvalidArgumentException('Slack returned unexpected response format - expecting JSON object/array.');
            }

            # Slack should always put a "ok" key in the response.
            # If that's not "ok", retrieve the error code and build a SlackException.
            if(($content['ok'] ?? false) !== true) {
                throw SlackException::fromSlackCode($content['error'] ?? 'unknown_error');
            }

            # Ok, everything went fine!
            return $content;
        });
    }

    /***
     * Performs a call to the Slack API using Artax.
     *
     * @param string $method    The API method name (eg. users.info).
     * @param array  $arguments The API method named arguments.
     *
     * @return Promise
     */
    protected function doHttpRequestAsync(string $method, array $arguments) : Promise
    {
        $arguments = $this->serializeSlackArguments($arguments);

        if(!$this->token) {
            throw new \InvalidArgumentException('A token must be provided.');
        }

        $arguments['token'] = $this->token;

        $request = (new Artax\Request)
            ->setUri(static::BASE_URL.'/'.$method)
            ->setMethod('POST')
            ->setAllHeaders(['Content-Type' => 'application/x-www-form-urlencoded'])
            ->setBody(http_build_query($arguments));

        return $this->httpClient->request($request);
    }

    /**
     * Serializes argument before they are sent to the Slack API.
     * This transforms SlackObject references into IDs, dates into timestamps, PHP bools into integers, etc.
     *
     * @param array $arguments Array of named arguments.
     *
     * @return array The same arguments, serialized in an API-compliant format.
     */
    private function serializeSlackArguments(array $arguments) : array
    {
        foreach($arguments as &$value) {
            if($value instanceof \DateTime) {
                $value = (string) $value->getTimestamp();
            } elseif(is_bool($value)) {
                $value = (int) $value;
            } elseif(is_array($value)) {
                # The json_encode below may look a bit unexpected: that's because Slack does not supports JSON payloads,
                # but expects that arguments that are arrays to be JSON-encoded.
                $value = json_encode($this->serializeSlackArguments($value));
            } elseif($value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }
        }

        return $arguments;
    }
}