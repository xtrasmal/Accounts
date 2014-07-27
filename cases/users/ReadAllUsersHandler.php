<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class ReadAllUsersHandler extends BaseUserHandler implements HandlerInterface
{


    public function handle($request)
    {

        $response = $this->repo->all();
        $this->dispatch($response);

        return $this->respond($response);

    }

    public function dispatch($entity)
    {
        $entity = new User;
        $entity->readAllUsers($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    /**
     * @param $response
     * @return ReadAllUsersResponse
     */
    public function respond($response)
    {
        return new ReadAllUsersResponse($response);
    }

}
