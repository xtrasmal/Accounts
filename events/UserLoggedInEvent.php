<?php namespace App\Modules\Accounts\Events;

use App\Modules\Accounts\Models\User;
use Ill\Core\Events\Interfaces\EventInterface;

class UserLoggedInEvent implements EventInterface
{

    public $user;

    public function __construct(User $user)
    {

        $this->user = $user;

    }

    public function getName()
    {

        return 'accounts.user_loggedin';

    }

}
