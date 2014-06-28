<?php namespace Modules\Accounts\Cases\Users;

class ResetUserPasswordRequest
{

    public $password;
    public $email;

    public function __construct($email, $password)
    {

        $this->email = $email;
        $this->password = $password;

    }

}
