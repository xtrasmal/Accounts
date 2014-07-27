<?php namespace Modules\Accounts\Controllers;

use Illuminate\Support\MessageBag;
use Ill\System\Base\BaseFormController;
use Ill\Core\CommandBus\DefaultCommandBus;
use Modules\Accounts\Models\CreateUserForm;
use Modules\Accounts\Cases\Users\CreateUserRequest;

class CreateUserFormController extends BaseFormController
{

    private $form;
    private $bus;
    private $messages;

    public function __construct(CreateUserForm $form,
                                DefaultCommandBus $bus,
                                MessageBag $messages)
    {

        $this->form = $form;
        $this->bus = $bus;
        $this->messages = $messages;
    }


    public function createUser()
    {
        $input = $this->form->getInputData();

        if ( !  $this->form->isValid())
        {
            return $this->redirectBack(['errors' => $this->form->getErrors()]);
        }

        $command = new CreateUserRequest(
            $input['email'],
            $input['name'],
            $input['password']
        );

        $user = $this->bus->execute($command);

        if($user){
            return $this->redirectBack();
        } else{
            $this->messages->add('register-errors', 'The given emailaddress is already in use');
            return $this->redirectBack(['errors' => $this->messages]);
        }

    }

}
