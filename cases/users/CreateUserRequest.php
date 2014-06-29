<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\BehaviourPool\Interfaces\BehaviourPool;

class CreateUserRequest implements BehaviourPool
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

    public function explain()
    {
        return [
            'feature' => 'Can create a new User',
        ];
    }

}
