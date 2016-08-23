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
 * MessageComposer
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
final class MessageComposer
{
    /** @var WebClient */
    private $webClient;

    /** @var array */
    private $payload = [];

    /** @var string */
    private $afterSentId;

    /** @var string */
    private $afterSentChannel;

    /**
     * @internal MessageComposer constructor. Should not be used directly, use Slamp\WebClient::compose() instead.
     *
     * @param WebClient $webClient
     */
    public function __construct(WebClient $webClient)
    {
        $this->webClient = $webClient;
    }

    /**
     * Sets the bot's username.
     *
     * @param string $username
     *
     * @return MessageComposer
     */
    public function from(string $username) : MessageComposer
    {
        $this->payload['username'] = $username;

        return $this;
    }

    /**
     * Sets the channel, private group, or IM chat room to send the message to.
     *
     * @param string $channel - Posting to a public channel: use the channel name (#channel) or ID (eg. C024BE91L)
     *                        - Posting to a private group : use the group name (admin-lounge) or ID (eg. G012AC86C)
     *                        - Posting to an IM channel   : use the user name (@toverux) to post to the user's @slackbot channel,
     *                                                       or use IM channel ID (D023BB3L2) to appear as the bot.
     *
     * @return MessageComposer
     */
    public function to(string $channel) : MessageComposer
    {
        $this->payload['channel'] = $channel;

        return $this;
    }

    /**
     * Sets an icon for the bot posting the message.
     *
     * @param string $icon Either an emoji ID (":smile:") or an URL to a custom image.
     *
     * @return MessageComposer
     */
    public function withIcon(string $icon) : MessageComposer
    {
        $key = preg_match('/^:.+:$/', $icon) ? 'icon_emoji' : 'icon_url';

        $this->payload[$key] = $icon;

        return $this;
    }

    /**
     * Sets parsing strategy for the text.
     * @see https://api.slack.com/docs/message-formatting
     *
     * @param string $parsingType Either "full" or "none" (default "none")
     *
     * @return MessageComposer
     */
    public function withParsing(string $parsingType) : MessageComposer
    {
        $this->payload['parse'] = $parsingType;

        return $this;
    }

    /**
     * Sets whether to parse the message to find #channel or @user references or not.
     *
     * @param bool $shouldLink (default false)
     *
     * @return MessageComposer
     */
    public function linkingNames(bool $shouldLink) : MessageComposer
    {
        $this->payload['link_names'] = $shouldLink;

        return $this;
    }

    /**
     * Sets the message content and sends the message asynchronously (returning a promise).
     *
     * @param string $text The message content.
     *
     * @return Promise
     */
    public function sendAsync(string $text) : Promise
    {
        $this->payload['text'] = $text;

        $futureResponse = $this->webClient->callAsync('chat.postMessage', $this->payload);

        return pipe($futureResponse, function(array $result) {
            $this->afterSentId = $result['ts'];
            $this->afterSentChannel = $result['channel'];

            return $this;
        });
    }

    /**
     * Updates the message's text after it has been sent.
     *
     * @param string $text The new text.
     *
     * @return Promise
     */
    public function updateAsync(string $text) : Promise
    {
        if(!$this->afterSentId) {
            throw new \LogicException('This message has not been sent yet, cannot update it!');
        }

        $futureResponse = $this->webClient->callAsync('chat.update', [
            'channel' => $this->afterSentChannel,
            'ts' => $this->afterSentId,
            'text' => $text
        ]);

        return pipe($futureResponse, function() { return $this; });
    }

    /**
     * Deletes the message after it has been sent.
     *
     * @return Promise
     */
    public function deleteAsync() : Promise
    {
        if(!$this->afterSentId) {
            throw new \LogicException('This message has not been sent yet, cannot update it!');
        }

        $futureResponse = $this->webClient->callAsync('chat.delete', [
            'channel' => $this->afterSentChannel,
            'ts' => $this->afterSentId
        ]);

        return pipe($futureResponse, function() { return $this; });
    }
}
