<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Bank\InMemoryBank;
use Bank\InMemoryRepository;
use Assert\Assertion;

/**
 * Defines application features from the specific context.
 */
class BankContext implements Context
{
    private $bank;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->bank = new InMemoryBank(new InMemoryRepository());
    }

    /**
     * @Given a deposit of :amount on :date
     */
    public function aDepositOfOn($amount, $date)
    {
        $this->bank->deposit($amount);
    }

    /**
     * @Given a withdrawal of :amount on :date
     */
    public function aWithdrawalOfOn($amount, $date)
    {
        $this->bank->withdraw($amount);
    }

    /**
     * @Then statement should be:
     */
    public function statementShouldBe(TableNode $table)
    {
        $statement = $this->bank->getStatement();

        foreach ($table as $i => $row) {
            // Assertion::same($row['date'], $statement[$i]['date']);
            Assertion::same($row['credit'], $statement[$i]['credit']);
            Assertion::same($row['debit'], $statement[$i]['debit']);
            Assertion::same($row['balance'], $statement[$i]['balance']);
        }
    }
}
