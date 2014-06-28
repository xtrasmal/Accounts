<?php namespace Modules\Accounts\Events;

use Modules\Accounts\Models\User;
use Ill\Core\Events\Interfaces\EventInterface;

class UserPasswordRemindEvent implements EventInterface
{

    public $user;

    public function __construct(User $user)
    {

        $this->user = $user;

    }

    public function getName()
    {

        return 'accounts.user_password_reminder';

    }

}
