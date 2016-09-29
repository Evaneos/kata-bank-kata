<?php

namespace Bank;

interface Bank
{
    public function deposit($amount);

    public function withdraw($amount);

    public function getStatement();
}