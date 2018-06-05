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

use Amp\{Promise, function pipe};
use Slamp\SlackObjectMethods;
use Slamp\WebClient;

/**
 * Users-related methods.
 * The methods of this class reflect Slack's API and are listed alphabetically.
 *
 * @author Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 * @author Jerome Schaeffer <jer.schaeffer@gmail.com>
 *
 * @TODO Implement users.identity method
 */
class UsersMethods extends SlackObjectMethods
{
    /** @var AdminMethods */
    public $admin;

    /**
     * Used to add sub-methods to the user methods.
     *
     * @param WebClient $webClient
     */
    public function __construct(WebClient $webClient)
    {
        parent::__construct($webClient);

        $this->admin = new AdminMethods($webClient);
    }


    /** {@inheritdoc} */
    protected static function configureApiType() : array
    {
        return [
            'slackObjectClass'     => User::class,
            'endpointPrefix'       => 'users',
            'methodItemName'       => 'user',
            'methodCollectionName' => 'members'
        ];
    }

    /**
     * Gets the currently logged-in user.
     * This is not a native Slack method.
     *
     * @return Promise<User>
     */
    public function getMeAsync() : Promise
    {
        # We'll get the current user ID by calling auth.test, then we can infoAsync().
        return pipe(
            $this->webClient->callAsync('auth.test'),
            function(array $result) : Promise {
                return $this->infoAsync($result['user_id']);
            }
        );
    }

    /**
     * Finds out information about a user's presence.
     * Consult the presence documentation for more details.
     * @see https://api.slack.com/docs/presence
     * @see https://api.slack.com/methods/users.getPresence
     *
     * @param string|User $user    User to get presence info on. Defaults to the authed user.
     * @param array       $options Method optional arguments.
     *
     * @return Promise<UserPresenceReport>
     */
    public function getPresenceAsync($user = null, array $options = []) : Promise
    {
        if($user) $options += ['user' => $user];

        return $this->callMethodAsync(
            null, 'getPresence', $options,
            function(array $response) use($user) {
                return UserPresenceReport::create($this->webClient, $response + ['user' => $user]);
            }
        );
    }

    /**
     * Gets information about a team member.
     * @see https://api.slack.com/methods/users.info
     *
     * @param string|User $user    User to get info on.
     * @param array       $options Method optional arguments.
     *
     * @return Promise<User>
     */
    public function infoAsync($user, array $options = []) : Promise
    {
        return $this->callMethodWithObjectResult($user, 'info', $options);
    }

    /**
     * Gets a list of all users in the team. This includes deleted/deactivated users.
     * @see https://api.slack.com/methods/users.list
     *
     * @param array $options Method optional arguments:
     *                        - [bool presence = false] Whether to include presence data in the output
     *
     * @return Promise<User[]>
     */
    public function listAsync(array $options = []) : Promise
    {
        return $this->callMethodWithCollectionResult(null, 'list', $options);
    }

    /**
     * Lets the slack messaging server know that the authenticated user is currently active.
     * Consult the presence documentation for more details.
     * @see https://api.slack.com/docs/presence
     * @see https://api.slack.com/methods/users.setActive
     *
     * @param array $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function setActiveAsync(array $options = []) : Promise
    {
        return $this->callMethodAsync(null, 'setActive', $options);
    }

    /**
     * Lets you set the calling user's manual presence.
     * Consult the presence documentation for more details.
     * @see https://api.slack.com/docs/presence
     * @see https://api.slack.com/methods/users.setPresence
     *
     * @param string $presence Either "auto" or "away". You can use UserPresenceReport constants.
     * @param array  $options  Method optional arguments.
     *
     * @return Promise<void>
     */
    public function setPresenceAsync(string $presence, array $options = []) : Promise
    {
        return $this->callMethodAsync(null, 'setPresence', $options + ['presence' => $presence]);
    }
}
