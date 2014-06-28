<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Modules\Accounts\Repositories\UserRepository;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class ResetUserPasswordHandler implements HandlerInterface
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

        $user = $this->repo->getByEmail($command->email);

        if($user){

            $user->resetUserPassword($user);
            $this->dispatcher->dispatch($user->releaseEvents());
            $credentials = [
                'password'              =>  $command->password,
                'password_confirmation' =>  $command->password_confirmation,
                'email'                 =>  $command->email,
                'token'                 =>  $command->token
            ];
            $this->repo->resetPassword($credentials);
            return new ResetUserPasswordResponse($user);
        }

        return false;

    }

}
