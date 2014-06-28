<?php namespace Modules\Accounts\Validators;

use Illuminate\Validation\Factory;
use Modules\Accounts\Cases\Users\RemindUserPasswordRequest;
use Ill\Core\CommandBus\Exceptions\CommandValidationFailedException;

class ForgotPasswordValidator
{
    private $validationFactory;

    public function __construct(Factory $validationFactory)
    {

        $this->validationFactory = $validationFactory;

    }

    public function validate(RemindUserPasswordRequest $command)
    {

        $validator = $this->validationFactory->make(
            [
                'email'     => $command->email
            ],
            [
                'email'     => 'required|email'
            ]
        );

        if ($validator->fails()) {
            throw new CommandValidationFailedException($validator->messages()->toJson());
        }

    }
}
