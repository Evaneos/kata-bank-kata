<?php
namespace Kata\Bank\Tests\Unit\Test\Acceptance;

use Kata\Bank\BankAccount;

class AcceptanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_prints_statement_given_multiple_operations_proceeded()
    {
        $account = new BankAccount();

        $account->setDate(\DateTimeImmutable::createFromFormat('d/m/Y', '10/01/2012'));
        $account->deposit('1000.00');

        $account->setDate(\DateTimeImmutable::createFromFormat('d/m/Y', '13/01/2012'));
        $account->deposit('2000.00');

        $account->setDate(\DateTimeImmutable::createFromFormat('d/m/Y', '14/01/2012'));
        $account->withdrawal('500.00');

        $expectedStatementOutput = '';
        $expectedStatementOutput .= 'date || credit || debit || balance'."\n";
        $expectedStatementOutput .= '14/01/2012 || || 500.00 || 2500.00'."\n";
        $expectedStatementOutput .= '13/01/2012 || 2000.00 || || 3000.00'."\n";
        $expectedStatementOutput .= '10/01/2012 || 1000.00 || || 1000.00'."\n";

        $this->assertEquals($expectedStatementOutput, $account->getStatement());
    }
}

// Operation: withdrawals & deposits