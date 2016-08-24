<?php

namespace Slamp\Api\Endpoint\User\SlackObjects;

use Amp\Promise;
use Slamp\Api\SlackObject;

class Profile extends SlackObject
{
    /**
     * Gets user name (username).
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return $this['first_name'] ?? null;
    }

    /**
     * Gets user name (username).
     *
     * @return string
     */
    public function getLastName() : string
    {
        return $this['last_name'] ?? null;
    }

    /**
     * Gets user email. This value is not necessarily given by the user and may be null.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this['email'] ?? null;
    }

    /**
     * Gets user Skype username. This value is not necessarily given by the user and may be null.
     *
     * @return string|null
     */
    public function getSkype()
    {
        return $this['skype'] ?? null;
    }

    /**
     * Gets user profile picture URL. If the user didn't uploaded a picture, it will default to a placeholder.
     *
     * @param int $size Picture size, between 24, 32, 48, 72, 192, 512.
     *
     * @return string
     */
    public function getPicture(int $size = 512) : string
    {
        if (!isset($this["image_${size}"])) {
            throw new \DomainException("No images have a size of ${size}px. Choose between 24, 32, 48, 72, 192 and 512.");
        }

        return $this["image_${size}"];
    }
}