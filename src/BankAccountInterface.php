<?php
namespace Kata\Bank;

interface BankAccountInterface
{
    /**
     * @param string $amount
     * @return void
     */
    public function deposit($amount);

    /**
     * @param string $amount
     * @return void
     */
    public function withdrawal($amount);

    /**
     * @return string
     */
    public function getStatement();

    /**
     * @return mixed
     */
    public function getOperations();
}