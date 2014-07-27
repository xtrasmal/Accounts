<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class CreateUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {

        $user = User::register([
            'email'     => $command->email,
            'name'      => $command->name,
            'password'  => $command->password,
        ]);


        $this->repo->createUserForExistingTenant($user);

        $user->createUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new CreateUserResponse($user);

    }

}
