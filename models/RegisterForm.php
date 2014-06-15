<?php namespace Modules\Accounts\Models;

use Ill\System\Base\BaseForm;

class RegisterForm extends BaseForm
{

    protected $validationRules = [
        'name'      => 'required',
        'email'     => 'required|email|unique:users',
        'password'  => 'required'
    ];


}
