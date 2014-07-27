<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;
use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class LoginUserHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {
        $login = $this->repo->login($command->email, $command->password);
        if($login)
        {
            $entity = $this->repo->getByEmail($command->email);

            $this->dispatch($entity);

            return $this->respond($entity);

        }

        return false;
    }

    public function dispatch($entity)
    {
        $entity = new User();
        $entity->loginUser($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    public function respond($response)
    {
        return new LoginUserResponse($response);
    }

}
