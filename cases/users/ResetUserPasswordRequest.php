<?php namespace Modules\Accounts\Cases\Users;

class ResetUserPasswordRequest
{

    public $password;
    public $email;
    public $token;

    public function __construct($token, $email, $password, $password_confirmation)
    {
        $this->token                 = $token;
        $this->email                 = $email;
        $this->password              = $password;
        $this->password_confirmation = $password_confirmation;


    }

}

