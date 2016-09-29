<?php

namespace spec\KataBank;

use KataBank\Clock;
use KataBank\BankService;
use PhpSpec\ObjectBehavior;

class BankServiceSpec extends ObjectBehavior
{
    private $result;

    public function let()
    {
    }

    public function it_is_initializable()
    {
        $this->beAnInstanceOf(BankService::class);
    }

    public function it_should_print_statement_from_deposit_and_withdrawal()
    {
        $this->given_a_client_makes_a_deposit(1000, '2012-01-10');
        $this->given_a_client_makes_a_deposit(2000, '2012-01-13');
        $this->given_a_client_makes_a_withdrawal(500, '2012-01-14');
        $this->when_print_statement();
        $this->then_we_should_see(
            "date || credit || debit || balance\r"
            . "14/01/2012 || || 500.00 || 2500.00\r"
            . "13/01/2012 || 2000.00 || || 3000.00\r"
            . "10/01/2012 || 1000.00 || || 1000.00\r"
        );
    }

    private function given_a_client_makes_a_deposit($amount, $date)
    {
        Clock::setNow(\DateTimeImmutable::createFromFormat('Y-m-d', $date));
        $this->deposit($amount);
    }

    private function given_a_client_makes_a_withdrawal($amount, $date)
    {
        Clock::setNow(\DateTimeImmutable::createFromFormat('Y-m-d', $date));
        $this->withdrawal($amount);
    }

    private function when_print_statement()
    {
        $this->result = $this->getStatement();
    }

    private function then_we_should_see($expected)
    {
        $this->result->shouldBe($expected);
    }
}