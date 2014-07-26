<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class DeleteUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {

        $user       = $this->repo->getById($command->id);
        $response   = $this->repo->delete($user);

        $user = new User;
        $user->deleteUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new DeleteUserResponse($response);

    }

}
