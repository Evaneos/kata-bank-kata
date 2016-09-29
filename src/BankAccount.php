<?php
namespace Kata\Bank;

use Kata\Bank\Operation\Deposit;
use Kata\Bank\Operation\Withdrawal;

class BankAccount implements BankAccountInterface
{
    /**
     * @var \DateTimeInterface
     */
    private $currentDateTime;

    /**
     * @var Operation[]
     */
    private $operations;

    /**
     * BankAccount constructor.
     */
    public function __construct()
    {
        $this->operations = [];
        $this->currentDateTime = null;
    }

    /**
     * @param string $amount
     * @return void
     */
    public function deposit($amount)
    {
        $this->operations[] = new Deposit($amount, $this->currentDateTime);
    }

    /**
     * @param string $amount
     * @return void
     */
    public function withdrawal($amount)
    {
        $this->operations[] = new Withdrawal($amount, $this->currentDateTime);
    }

    /**
     * @return string
     */
    public function getStatement()
    {
        $statementsArray = [];
        $balance = 0;
        foreach ($this->operations as $value) {
            $statement = [$value->getDateTime()->format('d/m/Y')];
            $isDeposit = $value instanceof Deposit;
            $balance = $isDeposit ? $balance + $value->getAmount() : $balance - $value->getAmount();

            $statement[] = $isDeposit ? $value->getAmount() : '';
            $statement[] = $isDeposit ? '' : $value->getAmount();
            $statement[] = $balance;

            $statementsArray[] = $statement;
        }

        $statementsArray = array_reverse($statementsArray);

        $statements = $this->getStatementHeader();
        foreach ($statementsArray as $statement) {
            $statements .= implode(' || ', $statement)."\n";
        }
        return $statements;
    }

    public function setDate(\DateTimeInterface $currentDateTime)
    {
        $this->currentDateTime = $currentDateTime;
    }

    /**
     * @return Operation[]
     */
    public function getOperations()
    {
        return $this->operations;
    }


}