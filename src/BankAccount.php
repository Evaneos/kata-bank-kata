<?php

namespace KataBank;

class BankAccount
{
    /**
     * @var CreditOperation[]
     */
    private $history;

    /**
     * @var int
     */
    private $initialAmount;

    /**
     * BankAccount constructor.
     */
    public function __construct()
    {
        $this->initialAmount = 0;
        $this->history = [];
    }

    /**
     * @param $amount
     * @param \DateTimeImmutable $date
     */
    public function addOperation($amount, \DateTimeImmutable $date)
    {
        $this->history[] = new CreditOperation($amount, $date);
    }

    /**
     * @return CreditOperation[]
     */
    public function getHistory()
    {
        return $this->history;
    }
}