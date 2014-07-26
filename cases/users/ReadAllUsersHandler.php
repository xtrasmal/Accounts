<?php namespace Modules\Accounts\Cases\Users;

use Illuminate\Support\Facades\Log;
use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Monolog\Logger;

class ReadAllUsersHandler extends BaseUserHandler implements HandlerInterface
{


    public function handle($request)
    {

        $response = $this->repo->all();

        $user = new User;
        $user->readAllUsers($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new ReadAllUsersResponse($response);

    }

}
