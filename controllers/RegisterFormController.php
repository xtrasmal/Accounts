<?php namespace Modules\Accounts\Controllers;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Ill\System\Base\BaseFormController;
use Ill\Core\CommandBus\DefaultCommandBus;
use Modules\Accounts\Models\RegisterForm;
use Modules\Accounts\Cases\Users\RegisterUserRequest;

class RegisterFormController extends BaseFormController
{

    private $form;
    private $bus;
    private $messages;

    public function __construct(RegisterForm $form,
                                DefaultCommandBus $bus,
                                MessageBag $messages)
    {

        $this->form = $form;
        $this->bus = $bus;
        $this->messages = $messages;
    }


    public function registerUser()
    {
        $input = $this->form->getInputData();

        if ( !  $this->form->isValid())
        {
            return $this->redirectBack(['errors' => $this->form->getErrors()]);
        }

        $command = new RegisterUserRequest(
            $input['name'],
            $input['email'],
            Hash::make($input['password'])
        );

        $user = $this->bus->execute($command);

        if($user){
            return $this->redirectRoute('accounts.register');
        } else{

            $this->messages->add('register-errors', 'The given emailaddress is already in use');
            return $this->redirectBack(['errors' => $this->messages]);
        }

    }

}
