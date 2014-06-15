<?php namespace Modules\Accounts\Cases\Users;

class CreateUserRequest
{

    public $email;
    public $name;
    public $password;

    public function __construct($email, $name, $password)
    {

        $this->email    = $email;
        $this->name     = $name;
        $this->password = $password;

    }

}
