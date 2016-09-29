<?php

namespace spec\KataBank;

use KataBank\CreditOperation;
use KataBank\Operation;
use PhpSpec\ObjectBehavior;

class CreditOperationSpec extends ObjectBehavior
{
    private $amount;

    private $date;

    public function __construct()
    {
        $this->amount = 500;
        $this->date = \DateTimeImmutable::createFromFormat('Y-m-d', '2016-08-07');
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->amount,
            $this->date
        );
    }

    public function it_is_initializable()
    {
        $this->beAnInstanceOf(CreditOperation::class);
        $this->shouldHaveType(Operation::class);
    }

    public function it_should_have_an_amount()
    {
        $this->getAmount()->shouldReturn($this->amount);
    }

    public function it_should_have_a_date()
    {
        $this->getDate()->shouldBeLike($this->date);
    }

    public function it_should_retrieve_a_new_balance()
    {
        $this->getNewBalance(500)->shouldReturn(1000);
    }

}