<img src="https://raw.githubusercontent.com/geekdpt/slamp/develop/slamp.png" alt="Slamp logo" align="right">

# slamp

An asynchronous Slack [RTM](https://api.slack.com/rtm) & [Web](https://api.slack.com/web) APIs client for PHP 7, powered by the [Amp asynchronous framework](https://github.com/amphp), providing a typed experience and full-featured interfaces.

Forget those cURL wrappers and go async!

[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/d878db5a-ec42-4a12-995e-07422ffefa28.svg?style=flat-square&label=insight)](https://insight.sensiolabs.com/projects/e9103654-845f-40b7-8eeb-009e49e09067)
[![Packagist (Composer)](https://img.shields.io/packagist/v/geekdpt/slamp.svg?style=flat-square)](https://packagist.org/packages/geekdpt/slamp)
![MIT License](https://img.shields.io/packagist/l/geekdpt/slamp.svg?style=flat-square)

----------------

 1. [Installation](#installation)
 2. [Usage](#usage) we'll learn how to do those node-ish things
 3. Slamp APIs
    - [Web API](#web-api) call any Slack Web API methods
    - [Web API - Simple Message Composing](#simple-message-composing) a fluent API for sending messages
    - [RTM API](#rtm-api) realtime connection to your Slack team!
 4. [Error handling](#error-handling) because sh** always happens

----------------

## Installation

## Usage

## Web API

## Simple Message Composing

Inspired by [maknz/slack](https://github.com/maknz/slack), this API is based on top of the Web API and intends to provide a simple interface for sending messages to channels, groups or IM channels.
You have to create a Web API client to begin, then call `compose()` to create a new message instance.

A basic usage example could be:

```php
$client = Slamp\webClient(TOKEN);
yield $client->compose()->sendAsync('Hello there!');
```

You can also set the target channel and/or the bot name :

```php
yield $client->compose()->from('Hello Bot')->to('#general')->sendAsync('Hey, wassup #general?');
```

The `to("...")` argument supports different notations:
 - `#channel`, `C024BE91L` for a public channel
 - `private-group`, `G012AC86C` for a private group
 - `@username` to post an IM message to the @slackbot inbox of the receiver (you will _not_ appear as "slackbot")
 - `D023BB3L2` to post as the bot itself (and not slackbot like before) (you have to create such channel before)

You can even edit messages or delete them after they are sent:

```php
$message = yield $client->compose()->to('@guy')->sendAsync('I hate you');

# What I have done.. ?!
yield $message->updateAsync('I love u');

# I should calm down...
yield $message->deleteAsync();
```

Here is a more complete list of the possible calls:

```php
$msg = Slamp\webClient(TOKEN)->compose()
    ->from('Sender name')
    ->withIcon(':robot:') # emoji code, or custom image with an URL
    ->to('#channel')
    ->withParsing('full') # defaults to "none", see api.slack.com/docs/message-formatting
    ->linkingNames(true) # defaults to false, sets whether token like #general or @username are parsed and transformed into links
    ->sendAsync('the message text');
    
Amp\wait($msg);
```

**Note**: attachments are not yet supported.

**Warning**: Please do not rely on the type behind these methods. Just use the methods. Don't manipulate the MessageComposer direclty, as the way it is created may change radically in a future version.

## RTM API

## Error handling
