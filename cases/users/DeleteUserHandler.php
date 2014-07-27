<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class DeleteUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {

        $user       = $this->repo->getById($command->id);
        $this->repo->delete($user);

        $this->dispatch($user);

        return $this->respond($user);

    }

    public function dispatch($entity)
    {
        $entity = new User;
        $entity->deleteUser($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    public function respond($response)
    {
        return new DeleteUserResponse($response);
    }

}
