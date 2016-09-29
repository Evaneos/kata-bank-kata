<?php
namespace Kata\Bank\Tests\Unit;

use Kata\Bank\BankAccount;
use Kata\Bank\Operation\Deposit;
use Kata\Bank\Operation\Withdrawal;

class BankAccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_deposits_an_amount() {

        // Create a bankAccount
        $bankAccount = new BankAccount();

        // Call deposit method with the amount
        $bankAccount->deposit(2000);
        // Pull the last item from the bankAccount's Collection
        $operations = $bankAccount->getOperations();

        // Check the operations count = 1
        $this->assertNotEmpty($operations);
        $this->assertEquals(count($operations), 1, 'There should be only 1 operation');
        // Check the operations[0] object
        $this->assertEquals(
            new Deposit(2000, new \DateTimeImmutable('now')),
            $operations[0]
        );
    }

    /**
     * @test
     */
    public function it_withdraws_an_amount()
    {
        $bankAccount = new BankAccount();
        $bankAccount->withdrawal('1000');

        $operations = $bankAccount->getOperations();

        $this->assertNotEmpty($operations);
        $this->assertEquals(count($operations), 1, 'There should be only 1 operation');
        $this->assertEquals(
            new Withdrawal('1000', new \DateTimeImmutable('now')),
            $operations[0]
        );
    }

}