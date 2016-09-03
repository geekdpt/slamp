<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp\Slack;

use Amp\{Promise, function all};
use Slamp\SlackObject;

/**
 * File object.
 * @see https://api.slack.com/types/file
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * @TODO Implement a method like getSharedInAsync() that returns the channels, groups and IMs where the file has been shared.
 */
class File extends SlackObject
{
    public const MODE_HOSTED = 'hosted';
    public const MODE_EXTERNAL = 'external';
    public const MODE_SNIPPET = 'snippet';
    public const MODE_POST = 'post';

    /**
     * Gets the file creation date.
     *
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime
    {
        return (new \DateTime)->setTimestamp($this['created']);
    }

    /**
     * Gets the file name.
     *
     * @return string
     */
    public function getFileName() : string
    {
        return $this['name'];
    }

    /**
     * Gets the file title.
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this['title'];
    }

    /**
     * Gets the file MIME type.
     *
     * @return string
     */
    public function getMimeType() : string
    {
        return $this['mimetype'];
    }

    /**
     * Gets the file type.
     * As the MIME type could be the same for different type of contents (text/plain for JS, HTML, etc), the fle_type
     * property tries to be more accurate about describing what contains the file.
     *
     * Possible file types are listed here: https://api.slack.com/types/file
     *
     * @return string
     */
    public function getFileType() : string
    {
        return $this['filetype'];
    }

    /**
     * Gets a more human-readable file type (ex. "Text")
     *
     * @return string
     */
    public function getPrettyType() : string
    {
        return $this['pretty_type'];
    }

    /**
     * Gets the user who created the file.
     *
     * @return Promise<User>
     */
    public function getUserAsync() : Promise
    {
        return $this->webClient->users->infoAsync($this['user']);
    }

    /**
     * Gets the file mode ("hosted", "external", "snippet", "post").
     * You can compare the returned value to this class' MODE_* constants.
     *
     * @return string
     */
    public function getMode() : string
    {
        return $this['mode'];
    }

    /**
     * Gets whether the file is stored in an editable mode.
     *
     * @return bool
     */
    public function isEditable() : bool
    {
        return $this['editable'];
    }

    /**
     * If the file is stored outside of Slack's servers, gets the name of the external host (ex. "gdoc", "dropbox"...).
     *
     * @return string|null Returns null if the file is stored by Slack.
     */
    public function getExternalHost() : ?string
    {
        return $this['is_external'] ? $this['external_type'] : null;
    }

    /**
     * Gets the file size, in bytes.
     *
     * @return int
     */
    public function getSize() : int
    {
        return $this['size'];
    }

    /**
     * Gets the file private URL
     *
     * @return string
     */
    public function getPrivateUrl() : string
    {
        return $this['url_private'];
    }

    /**
     * Gets the permalink private URL
     *
     * @return string
     */
    public function getPrivatePermalink() : string
    {
        return $this['permalink'];
    }

    /**
     * Gets a preview of the contents of a post or snippet.
     *
     * @return string
     */
    public function getPreview() : string
    {
        if(!in_array($this['mode'], [self::MODE_SNIPPET, self::MODE_POST])) {
            throw new \LogicException('Preview is available for posts and snippets only.');
        }

        return $this['preview'];
    }

    /**
     * Gets a highlighted preview of a code snippet.
     *
     * @return string
     */
    public function getHighlightedPreview() : string
    {
        if($this['mode'] != self::MODE_SNIPPET) {
            throw new \LogicException('Highlighted preview is available for code snippets only.');
        }

        return $this['preview_highlight'];
    }

    /**
     * Gets whether the file is public.
     *
     * @return bool
     */
    public function isPublic() : bool
    {
        return $this['is_public'];
    }

    /**
     * Gets whether the file has been publicly shared.
     *
     * @return bool
     */
    public function isPubliclyShared() : bool
    {
        return $this['public_url_shared'];
    }

    /**
     * Gets the public permalink URL, if the file has been publicly shared.
     *
     * @return string
     */
    public function getPublicPermalink() : string
    {
        # No need to check public_url_shared because the permalink exists even if an user has not yet
        # retrieved the link. In fact, public_url_shared seems to be just indicative.
        if(!$this['is_public']) {
            throw new \LogicException('This file is not public');
        }

        return $this['permalink_public'];
    }

    /**
     * Gets the number of users that starred the file
     *
     * @return int
     */
    public function getStarsCount() : int
    {
        return $this['num_stars'] ?? 0;
    }
}