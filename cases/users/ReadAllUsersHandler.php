<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class ReadAllUsersHandler extends BaseUserHandler implements HandlerInterface
{


    public function handle($request)
    {
        //$context = \App::make('Ill\System\Contexts\Context');

        $response = $this->repo->all();  //$context->all();

        $user = new User;
        $user->readAllUsers($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new ReadAllUsersResponse($response);

    }

}
