<?php

namespace KataBank;

abstract class Operation
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

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTimeImmutable $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param $initialBalance
     * @return int
     */
    abstract public function getNewBalance($initialBalance);
}