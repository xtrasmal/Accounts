<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\CommandBus\Interfaces\HandlerInterface;

class ResetUserPasswordHandler extends BaseUserHandler implements HandlerInterface
{

    public function handle($command)
    {

        $user = $this->repo->getByEmail($command->email);

        if($user){

            $credentials = [
                'password'              =>  $command->password,
                'password_confirmation' =>  $command->password_confirmation,
                'email'                 =>  $command->email,
                'token'                 =>  $command->token
            ];

            $response = $this->repo->resetPassword($credentials);
            $this->dispatch($user);
            return $this->respond($response);
        }

        return false;

    }

    public function dispatch($entity)
    {
        $entity->resetUserPassword($entity);
        $this->dispatcher->dispatch($entity->releaseEvents());
    }

    public function respond($response)
    {
        return new ResetUserPasswordResponse($response);
    }
}
