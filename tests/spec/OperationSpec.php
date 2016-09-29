<?php

namespace spec\KataBank;

use KataBank\Operation;
use PhpSpec\ObjectBehavior;

class OperationSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            500,
            \DateTimeImmutable::createFromFormat('Y-m-d', '2016-08-07')
        );
    }

    public function it_is_initializable()
    {
        $this->beAnInstanceOf(Operation::class);
    }

}