<?php

namespace spec\Bank;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bank\Bank;
use Bank\InMemoryBank;
use Bank\Repository;

class InMemoryBankSpec extends ObjectBehavior
{
    function let(Repository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryBank::class);
        $this->shouldImplement(Bank::class);
    }

    function it_should_deposit($repository)
    {
        $repository->addTransaction(1000)->shouldBeCalled();
        $this->deposit(1000);
    }

    function it_should_not_withdraw_with_negative_amount()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->duringWithdraw(-1000);
    }

    function it_should_withdraw($repository)
    {
        $repository->addTransaction(-1000)->shouldBeCalled();
        $this->withdraw(1000);
    }

    function it_should_get_statement($repository)
    {
        $this->deposit(1000);
        $this->withdraw(1000);
        $repository->getTransactions()->willReturn([
            ['amount' => 1000],
            ['amount' => -1000]
        ]);
        $repository->getTransactions()->shouldBeCalled();
        $this->getStatement()->shouldReturn([
            ['credit' => '0.00', 'debit' => '1000.00', 'balance' => '0.00'],
            ['credit' => '1000.00', 'debit' => '0.00', 'balance' => '1000.00']
        ]);
    }
}