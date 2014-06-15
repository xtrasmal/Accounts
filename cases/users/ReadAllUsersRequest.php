<?php namespace Modules\Accounts\Cases\Users;

class ReadUserAllRequest
{

    public $id;

    public function __construct($id)
    {

        $this->id    = $id;

    }

}
