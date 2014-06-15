<?php namespace Modules\Accounts\Models;

use Illuminate\Auth\UserInterface;
use Ill\Core\Events\EventGenerator;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Events\UserReadEvent;
use Modules\Accounts\Events\UsersReadEvent;
use Modules\Accounts\Events\UserDeletedEvent;
use Modules\Accounts\Events\UserUpdatedEvent;
use Modules\Accounts\Events\UserCreatedEvent;
use Modules\Accounts\Events\UserLoggedInEvent;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Modules\Accounts\Events\UserRegisteredEvent;

class User extends Model implements UserInterface, RemindableInterface
{
    use EventGenerator;
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

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {

        return $this->email;

    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {

        return $this->getKey();

    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {

        return $this->password;

    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {

    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {

    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {

    }

}
