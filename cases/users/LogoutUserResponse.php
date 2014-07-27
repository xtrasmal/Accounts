<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;

class LogoutUserResponse
{

    protected $user;

    public function __construct(User $user)
    {

        $this->user = $user;

    }


}
