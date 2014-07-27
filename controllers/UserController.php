<?php namespace Modules\Accounts\Controllers;

use Ill\System\Base\BaseController;
use Input,Hash;
use Modules\Accounts\Cases\Users\ReadUserRequest;
use Modules\Accounts\Cases\Users\CreateUserRequest;
use Modules\Accounts\Cases\Users\LogoutUserRequest;

class UserController extends BaseController
{
    // Todo: Read all users, Update user, Create user needs finishing

    public function createUser()
    {
        $command = new CreateUserRequest(
            Input::get('email'),
            Input::get('name'),
            Hash::make(Input::get('password'))
        );

        $this->bus->execute($command);

        return $this->redirectBack();

    }

    public function readUser($id)
    {

        $request = new ReadUserRequest($id);

        $response = $this->bus->execute($request);

        return $this->redirectAction('UserViewController@singleUserView');

    }

    public function deleteUser($id)
    {

        $command = new DeleteUserRequest($id);

        $this->bus->execute($command);

        return $this->redirectBack();

    }

    public function logoutUser()
    {

        $command = new LogoutUserRequest();

        $this->bus->execute($command);

        return $this->redirectAction('accounts.login');

    }

}
