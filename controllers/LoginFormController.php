<?php namespace Modules\Accounts\Controllers;

use Illuminate\Support\MessageBag;
use Ill\System\Base\BaseFormController;
use Ill\Core\CommandBus\DefaultCommandBus;
use Modules\Accounts\Models\LoginForm;
use Modules\Accounts\Cases\Users\LoginUserRequest;

class LoginFormController extends BaseFormController
{

    public $form;
    public $bus;
    public $messages;

    public function __construct(LoginForm $form,
                                DefaultCommandBus $bus,
                                MessageBag $messages)
    {

        $this->form = $form;
        $this->bus = $bus;
        $this->messages = $messages;

    }


    public function loginUser()
    {
        $input = $this->form->getInputData();

        if ( !  $this->form->isValid())
        {
            return $this->redirectBack(['errors' => $this->form->getErrors()]);
        }
        $command = new LoginUserRequest(
            $input['email'],
            $input['password']
        );

        $user = $this->bus->execute($command);

        if($user){
            return $this->redirectRoute('accounts.register');
        } else{

            $this->messages->add('login-errors', 'Could not log you in with the given credentials');
            return $this->redirectBack(['errors' => $this->messages]);
        }



    }


}
