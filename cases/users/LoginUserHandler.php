<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Modules\Accounts\Models\User;
use Modules\Accounts\Repositories\UserRepository;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class LoginUserHandler implements HandlerInterface
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

        if($this->repo->login($command->email, $command->password))
        {

            $user = new User();
            $user->loginUser($user);

            $this->dispatcher->dispatch($user->releaseEvents());

            return new LoginUserResponse($user);

        }

        return false;
    }

}
