<?php namespace Modules\Accounts\Cases\Users;

use Ill\Core\BehaviourPool\Interfaces\BehaviourPool;

class DeleteUserRequest implements BehaviourPool
{

    public $id;

    public function __construct($id)
    {

        $this->id    = $id;

    }

    public function explain()
    {

    }
}
