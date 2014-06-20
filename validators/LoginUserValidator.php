<?php namespace Modules\Accounts\Validators;

use Illuminate\Validation\Factory;
use Modules\Accounts\Cases\Users\LoginUserRequest;
use Ill\Core\CommandBus\Exceptions\CommandValidationFailedException;

class LoginUserValidator
{
    private $validationFactory;

    public function __construct(Factory $validationFactory)
    {

        $this->validationFactory = $validationFactory;

    }

    public function validate(LoginUserRequest $command)
    {

        $validator = $this->validationFactory->make(
            [
                'email'     => $command->email,
                'password'  => $command->password
            ],
            [
                'email'     => 'required',
                'password'  => 'required'
            ]
        );

        if ($validator->fails()) {
            throw new CommandValidationFailedException($validator->messages()->toJson());
        }

    }
}
