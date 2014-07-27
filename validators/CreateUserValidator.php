<?php namespace Modules\Accounts\Validators;

use Illuminate\Validation\Factory;
use Modules\Accounts\Cases\Users\CreateUserRequest;
use Ill\Core\CommandBus\Exceptions\CommandValidationFailedException;

class CreateUserValidator
{
    private $validationFactory;

    public function __construct(Factory $validationFactory)
    {

        $this->validationFactory = $validationFactory;

    }

    public function validate(CreateUserRequest $command)
    {

        $validator = $this->validationFactory->make(
            [
                'email'     => $command->email,
                'name'      => $command->name,
                'password'  => $command->password,
            ],
            [
                'email'     => 'required|email',
                'name'      => 'required',
                'password'  => 'required',
            ]
        );

        if ($validator->fails()) {
            throw new CommandValidationFailedException($validator->messages()->toJson());
        }

    }
}
