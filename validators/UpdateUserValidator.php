<?php namespace App\Modules\Accounts\Validators;

use Illuminate\Validation\Factory;
use App\Modules\Accounts\Cases\Users\UpdateUserCommand;
use Ill\Core\CommandBus\Exceptions\CommandValidationFailedException;

class UpdateUserValidator
{
    private $validationFactory;

    public function __construct(Factory $validationFactory)
    {

        $this->validationFactory = $validationFactory;

    }

    public function validate(UpdateUserCommand $command)
    {

        $validator = $this->validationFactory->make(
            [
                'id'   => $command->id,
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
