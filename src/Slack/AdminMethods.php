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

use Amp\{Promise};
use Slamp\SlackObjectMethods;

/**
 * Admin-related methods.
 * The methods of this class reflect Slack's API and are listed alphabetically.
 *
 * @author Jerome Schaeffer <jer.schaeffer@gmail.com>
 */
class AdminMethods extends SlackObjectMethods
{
    /** {@inheritdoc} */
    protected static function configureApiType() : array
    {
        return [
            'slackObjectClass'     => User::class,
            'endpointPrefix'       => 'users.admin',
            'methodItemName'       => 'user',
            'methodCollectionName' => 'members'
        ];
    }

    /**
     * Invite someone to join the team.
     * @see https://github.com/ErikKalkoken/slackApiDoc/blob/master/users.admin.invite.md
     *
     * @param string    $email   Email address of the person becoming invited.
     * @param array     $options Method optional arguments.
     *
     * @return Promise<void>
     */
    public function inviteAsync(string $email, array $options = []) : Promise
    {
        return $this->callMethodAsync(null, 'invite', $options + ['email' => $email]);
    }
}
