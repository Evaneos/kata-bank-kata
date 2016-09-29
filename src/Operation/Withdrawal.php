<?php
namespace Kata\Bank\Operation;

class Withdrawal implements Operation
{
    /** @var string  */
    private $amount;

    /** @var \DateTime|null */
    private $dateTime;

    /**
     * Deposit constructor.
     * @param string $amount
     * @param \DateTimeInterface|null $dateTime
     */
    public function __construct($amount, \DateTimeInterface $dateTime = null) {
        if ($dateTime === null) {
            $dateTime = new \DateTimeImmutable('now');
        }
        $this->amount = $amount;
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }
}