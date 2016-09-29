<?php

namespace spec\KataBank;

use KataBank\BankAccount;
use KataBank\Clock;
use KataBank\BankService;
use PhpSpec\ObjectBehavior;

class BankServiceSpec extends ObjectBehavior
{
    private $result;

    public function let(BankAccount $bankAccount)
    {
        $this->beConstructedWith(
            $bankAccount
        );
    }

    public function it_is_initializable()
    {
        $this->beAnInstanceOf(BankService::class);
    }

    public function it_should_call_bank_account_to_add_operation_when_i_make_a_deposit(BankAccount $bankAccount)
    {
        $amount = 1500;
        $date = '2012-01-15';

        $this->when_a_client_makes_a_deposit($amount, $date);
        $this->then_it_should_add_operation_to_bank_account($bankAccount, $amount, $date);
    }

    public function it_should_call_bank_account_to_add_operation_when_i_make_a_withdrawal(BankAccount $bankAccount)
    {
        $amount = 1500;
        $date = '2012-01-15';

        $this->when_a_client_makes_a_withdrawal($amount, $date);
        $this->then_it_should_add_operation_to_bank_account($bankAccount, -$amount, $date);
    }

    public function it_should_print_statement_from_deposit_and_withdrawal()
    {
        //TODO build with real implem
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
        $this->a_client_makes_a_deposit($amount, $date);
    }

    private function when_a_client_makes_a_deposit($amount, $date)
    {
        $this->a_client_makes_a_deposit($amount, $date);
    }

    private function when_a_client_makes_a_withdrawal($amount, $date)
    {
        $this->a_client_makes_a_withdrawal($amount, $date);
    }

    private function given_a_client_makes_a_withdrawal($amount, $date)
    {
        $this->a_client_makes_a_withdrawal($amount, $date);
    }

    private function when_print_statement()
    {
        $this->result = $this->getStatement();
    }

    private function then_we_should_see($expected)
    {
        $this->result->shouldBe($expected);
    }

    /**
     * @param $amount
     * @param $date
     */
    private function a_client_makes_a_deposit($amount, $date)
    {
        Clock::setNow(\DateTimeImmutable::createFromFormat('Y-m-d', $date));
        $this->deposit($amount);
    }

    /**
     * @param $amount
     * @param $date
     */
    private function a_client_makes_a_withdrawal($amount, $date)
    {
        Clock::setNow(\DateTimeImmutable::createFromFormat('Y-m-d', $date));
        $this->withdrawal($amount);
    }

    private function then_it_should_add_operation_to_bank_account($bankAccount, $amount, $date)
    {
        $bankAccount
            ->addOperation($amount, \DateTimeImmutable::createFromFormat('Y-m-d', $date))
            ->shouldHaveBeenCalled();
    }
}