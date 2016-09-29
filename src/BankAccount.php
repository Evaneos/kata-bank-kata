<?php

namespace KataBank;

class BankAccount
{
    private $history = [];

    public function addOperation($amount, \DateTimeImmutable $date)
    {
        $this->history[] = new Operation($amount, $date);
    }

    public function getHistory()
    {
        return $this->history;
    }
}