<?php namespace Modules\Accounts\Cases\Users;

class RegisterUserRequest
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function __construct($name, $email, $password, $password_confirmation)
    {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

}
