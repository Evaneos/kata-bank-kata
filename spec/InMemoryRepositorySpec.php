<?php

namespace spec\Bank;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bank\InMemoryRepository;
use Bank\Repository;

class InMemoryRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryRepository::class);
        $this->shouldImplement(Repository::class);
    }

    function it_should_add_transaction()
    {
        $this->addTransaction(1000);
    }

    function it_should_get_transactions()
    {
        $this->addTransaction(1000);
        $this->getTransactions()->shouldReturn([
            [
                'amount' => 1000
            ]
        ]);
    }
}
