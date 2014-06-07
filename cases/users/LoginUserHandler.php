<?php namespace App\Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use App\Modules\Accounts\Models\User, Auth;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use App\Modules\Accounts\Validators\LoginUserValidator;
use App\Modules\Accounts\Repositories\EloquentUserRepository;

class LoginUserHandler implements HandlerInterface
{

    private $repo;
    private $dispatcher;
    private $validator;

    public function __construct(EloquentUserRepository $repo,
                                Dispatcher $dispatcher,
                                LoginUserValidator $validator)
    {

        $this->repo = $repo;
        $this->dispatcher = $dispatcher;
        $this->validator = $validator;

    }

    public function handle($command)
    {

        $this->validator->validate($command);

        if (Auth::attempt(['email' => $command->email, 'password' => $command->password]))
        {
            $user = new User();

            $user->loginUser($user);

            $this->dispatcher->dispatch($user->releaseEvents());
            return new LoginUserResponse($user);
        }


    }

}
