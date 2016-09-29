<?php

namespace KataBank;

class Operation
{
    /**
     * @var
     */
    private $amount;
    /**
     * @var \DateTimeImmutable
     */
    private $date;

    public function __construct($amount, \DateTimeImmutable $date)
    {

        $this->amount = $amount;
        $this->date = $date;
    }
}