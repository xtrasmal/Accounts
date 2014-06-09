<?php namespace App\Modules\Accounts\Models;

use Ill\System\Base\BaseForm;

class LoginForm extends BaseForm
{

    protected $validationRules = [
        'email'    => 'required|email',
        'password' => 'required'
    ];


}
