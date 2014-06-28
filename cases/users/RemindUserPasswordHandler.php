<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Repositories\UserRepository;
use Modules\Accounts\Validators\ForgotPasswordValidator;

class RemindUserPasswordHandler implements HandlerInterface
{

    private $repo;
    private $dispatcher;
    private $validator;

    public function __construct(UserRepository $repo,
                                Dispatcher $dispatcher,
                                ForgotPasswordValidator $validator)
    {

        $this->repo = $repo;
        $this->dispatcher = $dispatcher;
        $this->validator = $validator;

    }

    public function handle($command)
    {
        $this->validator->validate($command);

        $user = $this->repo->getByEmail($command->email);

        if($user){

            $user->remindUserPassword($user);
            $this->dispatcher->dispatch($user->releaseEvents());
            $this->repo->remindPassword(['email' => $command->email]);

            return new RemindUserPasswordResponse($user);
        }

        return false;

    }

}
