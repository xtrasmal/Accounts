<?php namespace Modules\Accounts\Repositories;

use Hash, Password;
use Modules\Accounts\Models\User;

class EloquentUserRepository implements UserRepository
{

    private $model;

    public function __construct(User $model)
    {

        $this->model = $model;

    }

    public function getById($id)
    {

        return $this->model->where('id', '=', $id)->first();

    }

    public function getByEmail($email)
    {
        return $this->model->where('email', '=', $email)->first();
    }

    public function getAll()
    {

        return $this->model->all();

    }

    public function remindPassword($credentials)
    {
        return Password::remind($credentials);
    }

    public function resetPassword($credentials)
    {

        return Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

        });
    }

    public function save(User $model)
    {

        $model->save();

    }

    public function delete(User $model)
    {

        $model->delete();

    }

}
