<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class RegisterUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {

        $user = User::register([
            'email'     => $command->email,
            'name'      => $command->name,
            'password'  => $command->password
        ]);

        $this->repo->save($user);

        $user->registerUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new RegisterUserResponse($user);

    }


}
