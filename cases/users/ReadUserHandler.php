<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class ReadUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($request)
    {

        $response = $this->repo->getById($request->id);

        $this->dispatch($response);

        return $this->respond($response);

    }

    public function dispatch($entity)
    {
        $entity = new User;
        $entity->readUser($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    /**
     * @param $response
     * @return ReadUserResponse
     */
    public function respond($response)
    {
        return new ReadUserResponse($response);
    }

}
