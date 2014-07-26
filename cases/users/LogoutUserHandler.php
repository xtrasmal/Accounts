<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class LogoutUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {
        $this->repo->logout();

        $user = new User();
        $user->logoutUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new LogoutUserResponse();

    }

}
