<?php
/**
 * Created by PhpStorm.
 * User: Neofox
 * Date: 24/08/2016
 * Time: 11:30
 */

namespace Slamp\Api\Endpoint\User;


use Amp\Deferred;
use Amp\Promise;
use Slamp\Api\ChannelInteractivable;
use Slamp\Api\ChannelInteractiveTrait;
use Slamp\Api\Endpoint\User\SlackObjects\User;
use Slamp\Api\Endpoint;
use Slamp\WebClient;

class UserEndpoint extends Endpoint implements ChannelInteractivable
{
    use ChannelInteractiveTrait;

    /** @var string */
    protected $user;


    /**
     * UserEndpoint constructor.
     *
     * @param WebClient $webClient
     * @param string    $user
     */
    public function __construct(WebClient $webClient, string $user)
    {
        $this->user = $user;

        parent::__construct($webClient);
    }

    public function profile()
    {
        return new UserProfileEndpoint($this->getWebClient(), $this->payload);
    }

    /**
     * Gets the currently logged-in user.
     *
     * @return Promise<User>
     */
    public function meAsync() : Promise
    {
        $promisor = new Deferred;
        # We'll get the current user ID by calling auth.test
        $this->webClient->callAsync('auth.test')->when(
            function (\Throwable $err = null, array $result = null) use ($promisor) {
                if ($err) {
                    $promisor->fail($err);

                    return;
                }
                # Now we have the user ID, let's call self::infoAsync() to get a User object.
                $this->infoAsync($result['user_id'])->when(
                    function (\Throwable $err = null, User $me = null) use ($promisor) {
                        $err ? $promisor->fail($err) : $promisor->succeed($me);
                    }
                );
            }
        );

        return $promisor->promise();

    }

    /**
     * Gets an user by ID.
     * @link https://api.slack.com/methods/users.info
     *
     * @param string $id
     *
     * @return Promise<User>
     */
    public function getAsync(string $id) : Promise
    {
        return $this->callMethodWithObjectResultAsync('info', ['user' => $id]);
    }

    /**
     * This method returns a list of all users in the team. This includes deleted/deactivated users.
     * @link https://api.slack.com/methods/users.list
     *
     * @param array $options
     *
     * @return Promise<User[]>
     */
    public function listAsync(array $options = []) : Promise
    {
        $payload = $this->payload + $options;

        return $this->callMethodWithCollectionResultAsync('list', $payload);
    }

    protected function configure() : array
    {
        return [
            'slackObjectClass' => User::class,
            'apiPrefix'        => 'users',
            'apiName'          => 'user',
            'apiNamePlural'    => 'members',
        ];
    }
}