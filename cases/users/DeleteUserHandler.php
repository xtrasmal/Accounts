<?php namespace App\Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use App\Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use App\Modules\Accounts\Repositories\EloquentUserRepository;


class DeleteUserHandler implements HandlerInterface
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

        $user       = $this->repo->getById($command->id);
        $response   = $this->repo->delete($user);

        $user = new User;
        $user->deleteUser($user);
        $this->dispatcher->dispatch($user->releaseEvents());

        return new DeleteUserResponse($response);

    }

}
