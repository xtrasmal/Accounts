<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Validators\CreateUserValidator;
use Modules\Accounts\Repositories\EloquentUserRepository;

class CreateUserHandler implements HandlerInterface
{

    private $repo;
    private $dispatcher;
    private $validator;

    public function __construct(EloquentUserRepository $repo,
                                Dispatcher $dispatcher,
                                CreateUserValidator $validator)
    {

        $this->repo = $repo;
        $this->dispatcher = $dispatcher;
        $this->validator = $validator;

    }

    public function handle($command)
    {

        $this->validator->validate($command);

        $user = User::register([
            'email'     => $command->email,
            'name'      => $command->name,
            'password'  => $command->password,
        ]);

        $user->createUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());
        $this->repo->save($user);
        return new CreateUserResponse($user);

    }

}
