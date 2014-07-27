<?php namespace Modules\Accounts\Repositories;

use Modules\Accounts\Models\User;

interface UserRepository
{

    public function all();

    public function getById($id);

    public function getByEmail($email);

    public function getAll();

    public function save(User $model);

    public function delete(User $model);

    public function remindPassword($credentials);

    public function resetPassword($credentials);

    public function login($email, $password);

    public function logout();

    public function createUserForExistingTenant(User $user);

}
