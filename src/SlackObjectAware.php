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

    protected function callMethodAsync($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        $type = static::getApiTypeDescription();

        if($subject) {
            $arguments[$type['methodItemName']] = $subject;
        }

        return pipe(
            $this->webClient->callAsync($type['endpointPrefix'].'.'.$method, $arguments),
            $transformer ?: function() { return; }
        );
    }

    protected function callMethodWithObjectResult($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        return pipe(
            $this->callMethodAsync($subject, $method, $arguments, $transformer ?: function($data) { return $data; }),
            function(array $response) {
                $data = $response[static::getApiTypeDescription()['methodItemName']];
                return $this->hydrateSlackObject($data);
            }
        );
    }

    protected function callMethodWithCollectionResult($subject, string $method, array $arguments = [], \Closure $transformer = null) : Promise
    {
        return pipe(
            $this->callMethodAsync($subject, $method, $arguments, $transformer ?: function($data) { return $data; }),
            function(array $response) {
                $rawSlackObjects = $response[static::getApiTypeDescription()['methodCollectionName']];

                $slackObjects = [];
                foreach($rawSlackObjects as $rawSlackObject) {
                    $slackObjects[] = $this->hydrateSlackObject($rawSlackObject);
                }

                return $slackObjects;
            }
        );
    }

    protected function hydrateSlackObject(array $data) : SlackObject
    {
        /** @var SlackObject $class */
        $class = static::getApiTypeDescription()['slackObjectClass'];

        return $class::create($this->webClient, $data);
    }
}