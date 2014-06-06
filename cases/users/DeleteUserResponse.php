<?php namespace App\Modules\Accounts\Cases\Users;

use App\Modules\Accounts\Models\User;

class DeleteUserResponse
{

    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;

    }


}
