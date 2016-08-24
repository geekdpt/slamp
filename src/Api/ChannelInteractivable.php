<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 15:02
 */

namespace Slamp\Api;


interface ChannelInteractivable
{
    public function to(string $to);

    public function from(string $from);

}