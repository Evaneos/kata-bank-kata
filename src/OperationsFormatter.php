<?php

namespace KataBank;

class OperationsFormatter
{
    /**
     * @param CreditOperation[] $operations
     * @param int $balance
     * @return string
     */
    public function format(array $operations, $balance)
    {
        $lines = ['date || credit || debit || balance'];
        foreach ($operations as $operation) {
            $balance = $balance - $operation->getAmount();
            $lines[] = sprintf(
                '%s || || %0.2f || %0.2f',
                $operation->getDate()->format('d/m/Y'),
                $operation->getAmount(),
                $balance - $operation->getAmount()
            );
        }

        return implode("\r", $lines);
    }
}