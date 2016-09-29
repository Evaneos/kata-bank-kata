<?php

namespace spec\KataBank;

use KataBank\BankAccount;
use KataBank\Operation;
use PhpSpec\ObjectBehavior;

class BankAccountSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beAnInstanceOf(BankAccount::class);
    }

    public function it_should_add_operation_to_history()
    {
        $amount = 500;
        $date = '2015-05-06';

        $this->when_i_add_an_operation($amount, $date);
        $this->then_it_should_have_this_operation_in_history($amount, $date);
    }

    private function when_i_add_an_operation($amount, $date)
    {
        $this->addOperation($amount, \DateTimeImmutable::createFromFormat('Y-m-d', $date));

    }

    private function then_it_should_have_this_operation_in_history($amount, $date)
    {
        $this->getHistory()->shouldBeLike([
            new Operation($amount, \DateTimeImmutable::createFromFormat('Y-m-d', $date))
        ]);
    }
}