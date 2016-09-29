<?php

namespace Bank;

use Assert\Assertion;

class InMemoryBank implements Bank
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function deposit($amount)
    {
        $this->repository->addTransaction($amount);
    }

    public function withdraw($amount)
    {
        Assertion::greaterOrEqualThan($amount, 0);

        $this->repository->addTransaction($amount * -1);
    }

    public function getStatement()
    {
        return array_map(function($curr) {
            return array_map(function($value) {
                return number_format($value, 2, '.', '');
            }, $curr);
        }, array_reverse(
            array_reduce(
                $this->repository->getTransactions(),
                function ($acc, $transaction) {
                    $acc[] = [
                        'credit' => $transaction['amount'] >= 0 ? $transaction['amount'] : 0,
                        'debit' => $transaction['amount'] < 0 ? $transaction['amount'] * -1 : 0,
                        'balance' => (isset($acc[count($acc) - 1]) ? $acc[count($acc) - 1]['balance'] : 0) + $transaction['amount']
                    ];

                    return $acc;
                }, []
            )
        ));
    }
}
