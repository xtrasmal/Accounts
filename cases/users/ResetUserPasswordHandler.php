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

            $this->repo->resetPassword($credentials);


            $user->resetUserPassword($user);
            $this->dispatcher->dispatch($user->releaseEvents());

            return new ResetUserPasswordResponse($user);
        }

        return false;

    }

}
