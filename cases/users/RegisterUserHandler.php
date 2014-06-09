<?php namespace App\Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use App\Modules\Accounts\Models\User, Auth;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use App\Modules\Accounts\Repositories\EloquentUserRepository;

class RegisterUserHandler implements HandlerInterface
{

    private $repo;
    private $dispatcher;

    public function __construct(EloquentUserRepository $repo,
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

        $user->registerUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());
        $this->repo->save($user);
        return new RegisterUserResponse($user);

    }

}
