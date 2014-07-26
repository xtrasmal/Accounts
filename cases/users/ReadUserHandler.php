<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class ReadUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($request)
    {

        $response = $this->repo->getById($request->id);

        $user = new User;
        $user->readUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new ReadUserResponse($response);

    }

}
