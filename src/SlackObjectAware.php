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

use Amp\{Promise, function pipe};

/**
 * SlackObjectAware
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
abstract class SlackObjectAware
{
    /** @var WebClient */
    protected $webClient;

    /** @var array Cache for ::apiconf() */
    private $apiTypeDescription;

    /**
     * Gets the configuration for this Slack API/SlackObjects-aware Slamp component.
     *
     * Returns an array with the following keys/values:
     *  - slackObjectClass: (string) supported SlackObject class FQDN ;
     *  - endpointPrefix: (string) prefix of the main endpoint for this class ;
     *  - methodItemName: (string) name used in api method arguments and api method responses ;
     *  - methodCollectionName: (string) name used in api method responses
     *
     * @return array
     */
    abstract protected static function getApiTypeDescription() : array;

    /**
     * Calls a method, returns void by default.
     *
     * @param string|SlackObject|null $subject     The slackobject to pass in argument, or null
     * @param string                  $method      The method name, without the type prefix (channels.list => list)
     * @param array                   $arguments   Normal method arguments
     * @param \Closure|null           $transformer Transformer to apply on the response
     *
     * @return Promise
     */
    protected function callMethodAsync($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        if($subject) {
            $arguments[$this->apiconf('methodItemName')] = $subject;
        }

        return pipe(
            $this->webClient->callAsync($this->apiconf('endpointPrefix').'.'.$method, $arguments),
            $transformer ?: function() { return; }
        );
    }

    /**
     * Calls a method, retrieves the SlackObject in the response and returns it.
     *
     * @param string|SlackObject|null $subject     The slackobject to pass in argument, or null
     * @param string                  $method      The method name, without the type prefix (channels.list => list)
     * @param array                   $arguments   Normal method arguments
     * @param \Closure|null           $transformer Transformer to apply on the response
     *
     * @return Promise
     */
    protected function callMethodWithObjectResult($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        return pipe(
            $this->callMethodAsync($subject, $method, $arguments, $transformer ?: function($data) { return $data; }),
            function(array $response) {
                $data = $response[$this->apiconf('methodItemName')];
                return $this->hydrateSlackObject($data);
            }
        );
    }

    /**
     * Calls a method, retrieves the collection of SlackObjects in the response and returns it.
     *
     * @param string|SlackObject|null $subject     The slackobject to pass in argument, or null
     * @param string                  $method      The method name, without the type prefix (channels.list => list)
     * @param array                   $arguments   Normal method arguments
     * @param \Closure|null           $transformer Transformer to apply on the response
     *
     * @return Promise
     */
    protected function callMethodWithCollectionResult($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        return pipe(
            $this->callMethodAsync($subject, $method, $arguments, $transformer ?: function($data) { return $data; }),
            function(array $response) {
                $rawSlackObjects = $response[$this->apiconf('methodCollectionName')];

                $slackObjects = [];
                foreach($rawSlackObjects as $rawSlackObject) {
                    $slackObjects[] = $this->hydrateSlackObject($rawSlackObject);
                }

                return $slackObjects;
            }
        );
    }

    /**
     * Hydrates a SlackObject from an array.
     *
     * @param array $data SlackObject contents
     *
     * @return SlackObject
     */
    protected function hydrateSlackObject(array $data) : SlackObject
    {
        /** @var SlackObject $class */
        $class = $this->apiconf('slackObjectClass');

        return $class::createHydrated($this->webClient, $data);
    }

    /**
     * Gets a value by key from the API type's configuration (defined by static::getApiTypeDescription()).
     *
     * @param string $property
     *
     * @return string
     */
    private function apiconf(string $property) : string
    {
        return (
            $this->apiTypeDescription ?:
            ($this->apiTypeDescription = static::getApiTypeDescription())
        )[$property];
    }
}