<?php namespace Modules\Accounts\Models;

use Ill\System\Base\BaseForm;

class ForgotForm extends BaseForm
{

    protected $validationRules = [
        'email'    => 'required|email'
    ];


}
