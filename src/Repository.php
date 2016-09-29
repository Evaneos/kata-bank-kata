<?php

namespace Bank;

interface Repository
{
    public function addTransaction($amount);

    public function getTransactions();
}
