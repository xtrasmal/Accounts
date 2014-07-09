<?php namespace Modules\Accounts\Repositories;

use Hash, Password, Auth;
use Ill\System\Contexts\Context;
use Ill\System\Contexts\TenantRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Models\User;

class EloquentUserRepository extends TenantRepository implements UserRepository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Context
     */
    protected $scope;

    /**
     * Construct
     *
     */
    public function __construct(User $model, Context $scope)
    {
        $this->model = $model;
        $this->scope = $scope;
    }

    /**
     * Return all projects
     *
     * @param array $with
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        return $this->allThroughColumn($with);
    }

    /**
     * Return a single project
     *
     * @param array $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        return $this->findThroughColumn($id, $with);
    }

    /**
     * Get Results by Page
     *
     * @param int $page
     * @param int $limit
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, $with = array())
    {
        return $this->getByPageThroughColumn($page, $limit, $with);
    }

    /**
     * Search for a single result by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getFirstBy($key, $value, array $with = array())
    {
        return $this->getFirstByThroughColumn($key, $value, $with);
    }

    /**
     * Search for many results by key and value
     *
     * @param string $key
     * @param mixed $value
     * @param array $with
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getManyBy($key, $value, array $with = array())
    {
        return $this->getManyByThroughColumn($key, $value, $with);
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

    public function login($email, $password)
    {

        return Auth::attempt(['email' => $email, 'password' => $password]);

    }

}
