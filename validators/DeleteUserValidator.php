<?php namespace App\Modules\Accounts\Validators;

use Illuminate\Validation\Factory;
use App\Modules\Accounts\Cases\Users\DeleteUserCommand;
use Ill\Core\CommandBus\Exceptions\CommandValidationFailedException;

class DeleteUserValidator
{
    private $validationFactory;

    public function __construct(Factory $validationFactory)
    {

        $this->validationFactory = $validationFactory;

    }

    public function validate(DeleteUserCommand $command)
    {

        $validator = $this->validationFactory->make(
            [
                'id' => $command->id,
            ],
            [
                'id' => 'required',
            ]
        );

        if ($validator->fails()) {
            throw new CommandValidationFailedException($validator->messages()->toJson());
        }

    }
}
