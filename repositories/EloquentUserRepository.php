<?php namespace Modules\Accounts\Repositories;

use Ill\Core\Events\EventGenerator;
use Modules\Accounts\Models\User;
use Illuminate\Database\Eloquent\Model;

class EloquentUserRepository
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

    public function save(Model $model)
    {

        $model->save();

    }

    public function delete(Model $model)
    {

        $model->delete();

    }

}
