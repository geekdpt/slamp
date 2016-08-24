<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 12:05
 */

require __DIR__ . '../../vendor/autoload.php';

$client = new \Slamp\WebClient(getenv('SLACK_TOKEN'));

//$me = \Amp\wait($client->api()->users('U1G8DBHG8')->profile()->getAsync());
$me = \Amp\wait($client->api()->channels('C24EWMC6S')->unarchiveAsync());

var_dump($me);