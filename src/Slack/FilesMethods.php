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

use Amp\Promise;
use Slamp\SlackObjectMethods;

/**
 * Files-related methods.
 * The methods of this class reflect Slack's API and are listed alphabetically.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class FilesMethods extends SlackObjectMethods
{
    /** {@inheritdoc} */
    protected static function configureApiType() : array
    {
        return [
            'slackObjectClass'     => File::class,
            'endpointPrefix'       => 'files',
            'methodItemName'       => 'file',
            'methodCollectionName' => 'files'
        ];
    }

    /**
     * Deletes a file from your team.
     * @see https://api.slack.com/methods/files.delete
     *
     * @param string|File $file    File to delete
     * @param array       $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function deleteAsync($file, array $options = []) : Promise
    {
        return $this->callMethodAsync($file, 'delete', $options);
    }

    /**
     * Gets information about a file in your team.
     * @see https://api.slack.com/methods/files.info
     *
     * @param string|File $file    File to get informations on.
     * @param array       $options Method optional arguments:
     *                              - [int count = 100] Number of comments per page
     *                              - [int page = 1] Current page number
     *
     * @return Promise<File>
     */
    public function infoAsync($file, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($file, 'info', $options);
    }
}