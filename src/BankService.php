<?php

namespace KataBank;

class BankService
{
    /**
     * @var BankAccount
     */
    private $bankAccount;

    /**
     * BankService constructor.
     */
    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    public function deposit($amount)
    {
        $this->bankAccount->addOperation($amount, Clock::now());
    }

    public function withdrawal($amount)
    {
        $this->bankAccount->addOperation(-$amount, Clock::now());
    }

    public function getStatement()
    {
        
    }
}