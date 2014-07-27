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
        $this->dispatch($user);

        return $this->respond($user);
    }

    public function dispatch($entity)
    {
        $entity->registerUser($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    public function respond($response)
    {
        return new RegisterUserResponse($response);
    }
}
