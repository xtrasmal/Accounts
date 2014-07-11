<?php namespace Modules\Accounts\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Ill\Core\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Events\UserLoggedOutEvent;
use Modules\Accounts\Events\UserReadEvent;
use Modules\Accounts\Events\UsersReadEvent;
use Modules\Accounts\Events\UserDeletedEvent;
use Modules\Accounts\Events\UserUpdatedEvent;
use Modules\Accounts\Events\UserCreatedEvent;
use Modules\Accounts\Events\UserLoggedInEvent;
use Modules\Accounts\Events\UserRegisteredEvent;
use Modules\Accounts\Events\UserPasswordResetEvent;
use Modules\Accounts\Events\UserPasswordRemindEvent;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class User extends Model implements UserInterface, RemindableInterface
{
    use UserTrait;
    use EventGenerator;
    use RemindableTrait;
    use SoftDeletingTrait;


    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function register($attributes)
    {

        $user = new static([
            'email'       => $attributes['email'],
            'name'        => $attributes['name'],
            'password'    => $attributes['password'],
        ]);

        return $user;

    }

    public function createUser($user)
    {

        $this->raise(new UserCreatedEvent($user));
        return $user;

    }

    public function readUser($user)
    {

        $this->raise(new UserReadEvent($user));
        return $user;

    }

    public function readAllUsers($user)
    {

        $this->raise(new UsersReadEvent($user));
        return $user;

    }

    public function updateUser($user)
    {

        $this->raise(new UserUpdatedEvent($user));
        return $user;

    }

    public function deleteUser($user)
    {

        $this->raise(new UserDeletedEvent($user));
        return $user;

    }

    public function loginUser($user)
    {

        $this->raise(new UserLoggedInEvent($user));
        return $user;

    }

    public function registerUser($user)
    {

        $this->raise(new UserRegisteredEvent($user));
        return $user;

    }

    public function remindUserPassword($user)
    {

        $this->raise(new UserPasswordRemindEvent($user));
        return $user;

    }

    public function resetUserPassword($user)
    {

        $this->raise(new UserPasswordResetEvent($user));
        return $user;

    }

    public function logoutUser($user)
    {

        $this->raise(new UserLoggedOutEvent($user));
        return $user;

    }

    public function account()
    {
        $this->belongsTo('Modules\Accounts\Models\Account');
    }
}
