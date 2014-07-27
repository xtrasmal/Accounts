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

        $response = $this->repo->createUserForExistingTenant($user);

        $this->dispatch($user);
        return $this->respond($response);

    }

    public function dispatch($entity)
    {
        $entity>createUser($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
        return $entity;
    }

    public function respond($response)
    {

        return new CreateUserResponse($response);

    }
}
