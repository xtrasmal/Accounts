<?php namespace Modules\Accounts\Events;

use Modules\Accounts\Models\User;
use Ill\Core\Events\Interfaces\EventInterface;

class UsersReadEvent implements EventInterface
{

    public $user;

    public function __construct(User $user)
    {

        $this->user = $user;

    }

    public function getName()
    {

        return 'usersRead';

    }

}
