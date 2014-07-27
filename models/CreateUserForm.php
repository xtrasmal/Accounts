<?php namespace Modules\Accounts\Models;

use Ill\System\Base\BaseForm;

class CreateUserForm extends BaseForm
{

    protected $validationRules = [
        'name'                  => 'required',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|confirmed',
        'password_confirmation' => 'required'
    ];


}
