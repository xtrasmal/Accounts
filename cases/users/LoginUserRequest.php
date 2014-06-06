<?php namespace App\Modules\Accounts\Cases\Users;

class LoginUserRequest
{

    public $email;
    public $password;

    public function __construct($email, $password)
    {

        $this->email    = $email;
        $this->password = $password;

    }

}
