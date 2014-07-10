<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Modules\Accounts\Listeners\SetupTenantForUser;
use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Repositories\UserRepository;

class RegisterUserHandler implements HandlerInterface
{

    private $repo;
    private $dispatcher;

    public function __construct(UserRepository $repo,
                                Dispatcher $dispatcher)
    {

        $this->repo = $repo;
        $this->dispatcher = $dispatcher;

    }

    public function handle($command)
    {

        $user = User::register([
            'email'     => $command->email,
            'name'      => $command->name,
            'password'  => $command->password,
        ]);
        $this->repo->save($user);

        $user->registerUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new RegisterUserResponse($user);

    }

}
