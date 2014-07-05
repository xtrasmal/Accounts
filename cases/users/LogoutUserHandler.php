<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Modules\Accounts\Models\User, Auth;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Repositories\UserRepository;

class LogoutUserHandler implements HandlerInterface
{

    private $repo;
    private $dispatcher;

    public function __construct(UserRepository $repo,
                                Dispatcher $dispatcher)
    {

        $this->repo = $repo;
        $this->dispatcher = $dispatcher;

    }

    public function handle($command)
    {
        Auth::logout();

        $user = new User();
        $user->logoutUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new LogoutUserResponse();

    }

}
