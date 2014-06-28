<?php namespace Modules\Accounts\Controllers;

use Illuminate\Support\MessageBag;
use Ill\System\Base\BaseFormController;
use Ill\Core\CommandBus\DefaultCommandBus;
use Modules\Accounts\Models\ForgotForm;
use Modules\Accounts\Cases\Users\RemindUserPasswordRequest;

class ForgotFormController extends BaseFormController
{

    public $form;
    public $bus;
    public $messages;

    public function __construct(ForgotForm $form,
                                DefaultCommandBus $bus,
                                MessageBag $messages)
    {

        $this->form = $form;
        $this->bus = $bus;
        $this->messages = $messages;

    }


    public function resetUser()
    {
        $input = $this->form->getInputData();

        if ( !  $this->form->isValid())
        {
            return $this->redirectBack(['errors' => $this->form->getErrors()]);
        }
        $command = new RemindUserPasswordRequest(
            $input['email']
        );

        $user = $this->bus->execute($command);

        if($user){
            return $this->redirectRoute('accounts.login');
        } else{

            $this->messages->add('forgot-errors', 'No user found with that emailaddress');
            return $this->redirectBack(['errors' => $this->messages]);
        }



    }


}
