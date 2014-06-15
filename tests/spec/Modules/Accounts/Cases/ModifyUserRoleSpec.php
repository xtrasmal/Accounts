<?php

namespace spec\Modules\Accounts\Cases;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModifyUserRoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Modules\Accounts\Cases\ModifyUserRole');
    }
}
