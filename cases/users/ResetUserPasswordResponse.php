<?php namespace Modules\Accounts\Cases\Users;

use Modules\Accounts\Models\User;

class ResetUserPasswordResponse
{

    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;

    }


}
