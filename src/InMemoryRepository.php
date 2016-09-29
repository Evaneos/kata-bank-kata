<?php

namespace Bank;

class InMemoryRepository implements Repository
{
    private $transactions = [];

    public function addTransaction($amount)
    {
        $this->transactions[] = [
            'amount' => $amount
        ];
    }

    public function getTransactions()
    {
        return $this->transactions;
    }
}
