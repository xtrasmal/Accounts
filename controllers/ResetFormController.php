<?php namespace Modules\Accounts\Controllers;

use Illuminate\Support\MessageBag;
use Ill\System\Base\BaseFormController;
use Ill\Core\CommandBus\DefaultCommandBus;
use Modules\Accounts\Models\ResetForm;
use Modules\Accounts\Cases\Users\ResetUserPasswordRequest;

class ResetFormController extends BaseFormController
{

    public $form;
    public $bus;
    public $messages;

    public function __construct(ResetForm $form,
                                DefaultCommandBus $bus,
                                MessageBag $messages)
    {

        $this->form = $form;
        $this->bus = $bus;
        $this->messages = $messages;

    }


    public function resetPassword()
    {
        $input = $this->form->getInputData();

        if ( !  $this->form->isValid())
        {
            return $this->redirectBack(['errors' => $this->form->getErrors()]);
        }

        $command = new ResetUserPasswordRequest(
            $input['token'],
            $input['email'],
            $input['password'],
            $input['password_confirmation']
        );

        $user = $this->bus->execute($command);

        if($user){
            return $this->redirectRoute('accounts.login');
        } else{

            $this->messages->add('reset-errors', 'Please provide a password');
            return $this->redirectBack(['errors' => $this->messages]);
        }



    }


}
