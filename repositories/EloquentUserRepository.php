<?php namespace Modules\Accounts\Repositories;

use Ill\Core\Events\EventGenerator;
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

    public function getAll()
    {

        return $this->model->all();

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
