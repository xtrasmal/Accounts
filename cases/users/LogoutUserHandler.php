<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class LogoutUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {
        $logout = $this->repo->logout();

        $response = $this->dispatch($logout);

        return $this->respond($response);

    }

    /**
     * @return User
     */
    public function dispatch($entity)
    {
        $entity = new User();
        $entity->logoutUser($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
        return $entity;
    }

    /**
     * @param $response
     * @return LogoutUserResponse
     */
    public function respond($response)
    {
        return new LogoutUserResponse($response);
    }
}
