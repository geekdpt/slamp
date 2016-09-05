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

/**
 * Groups-related methods.
 * The methods of this class reflect Slack's API and are listed alphabetically.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 */
class GroupsMethods extends Channel\AbstractChannelsMethods
{
    /** {@inheritdoc} */
    protected static function configureApiType() : array
    {
        return [
            'slackObjectClass'     => Group::class,
            'endpointPrefix'       => 'groups',
            'methodIdArgumentName' => 'channel',
            'methodItemName'       => 'group',
            'methodCollectionName' => 'groups'
        ];
    }

    /**
     * Closes a group.
     * @see https://api.slack.com/methods/groups.close
     *
     * @param string|Group $group   Channel to rename.
     * @param array        $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function closeAsync($group, array $options = []) : Promise
    {
        return $this->callMethodAsync($group, 'close', $options);
    }

    /**
     * Clones an existing group by performing the following steps:
     *  - Renames the existing group (from "example" to "example-archived").
     *  - Archives the existing group.
     *  - Creates a new group with the name of the existing group.
     *  - Adds all members of the existing group to the new group.
     *
     * This is useful when inviting a new member to an existing group while hiding all previous chat history
     * from them. In this scenario you can call groups.createChild followed by groups.invite.
     *
     * The new group will have a special parent_group property pointing to the original archived group.
     * This will only be returned for members of both groups, so will not be visible to any newly invited members.
     * @see https://api.slack.com/methods/groups.createChild
     *
     * @param string|Group $group   Group to clone and archive.
     * @param array        $options Method optional arguments.
     *
     * @return Promise<Group>
     */
    public function createChildAsync($group, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($group, 'createChild', $options);
    }

    /**
     * Opens a group.
     * @see https://api.slack.com/methods/groups.open
     *
     * @param string|Group $group   Channel to rename.
     * @param array        $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function openAsync($group, array $options = []) : Promise
    {
        return $this->callMethodAsync($group, 'open', $options);
    }
}