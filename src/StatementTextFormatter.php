<?php
namespace Kata\Bank;

class StatementTextFormatter
{
    /**
     * @var string
     * @return string
     */
    private function getStatementHeader()
    {
        return 'date || credit || debit || balance'."\n";
    }
}
