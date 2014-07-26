<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class LoginUserHandler extends BaseUserHandler implements HandlerInterface
{

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
