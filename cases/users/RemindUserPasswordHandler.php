<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\Events\Dispatcher;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;
use Modules\Accounts\Repositories\UserRepository;
use Modules\Accounts\Validators\ForgotPasswordValidator;

class RemindUserPasswordHandler implements HandlerInterface
{

    protected $repo;
    protected $dispatcher;
    protected $validator;

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

            $user->remindPassword(['email' => $command->email]);

            $this->dispatch($user);

            return $this->respond($user);
        }

        return false;

    }

    public function dispatch($entity)
    {
        $entity->remindUserPassword($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    public function respond($response)
    {
        return new RemindUserPasswordResponse($response);
    }
}
