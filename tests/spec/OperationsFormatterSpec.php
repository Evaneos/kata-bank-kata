<?php

namespace spec\KataBank;

use KataBank\CreditOperation;
use PhpSpec\ObjectBehavior;

class OperationsFormatterSpec extends ObjectBehavior
{
    private $operations;
    private $finalBalance;
    private $result;

    public function it_is_initializable()
    {
        $this->beAnInstanceOf(OperationsFormatter::class);
    }

    public function it_should_format_operation_history()
    {
        $this->given_there_is_a_final_balance();
        $this->given_there_is_operations();
        $this->when_i_format_them();
        $this->then_i_should_have(
            "date || credit || debit || balance\r"
            . "14/01/2012 || || 500.00 || 2500.00\r"
            . "13/01/2012 || 2000.00 || || 3000.00\r"
        );
    }

    private function given_there_is_operations()
    {
        $this->operations = [
            new CreditOperation('500', \DateTimeImmutable::createFromFormat('Y-m-d', '2012-01-13')),
            new CreditOperation('2000', \DateTimeImmutable::createFromFormat('Y-m-d', '2012-01-14')),
        ];
    }

    private function given_there_is_a_final_balance()
    {
        $this->finalBalance = "3000";
    }

    private function when_i_format_them()
    {
        $this->result = $this->format($this->operations, $this->finalBalance);
    }

    private function then_i_should_have($expected)
    {
        $this->result->shouldbe($expected);
    }
}