<?php namespace BankKata;
/**
 * Created by PhpStorm.
 * User: juanlozano
 * Date: 29/09/16
 * Time: 17:14
 */
class BankAccount
{

    private $operations = [];

    private $clock;

    /**
     * BankAccount constructor.
     */
    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function deposit($amount){

        $date = $this->clock->today();
        $this->operations[] = new Deposit($date, $amount);
    }

    public function withdrawal($amount){
        $date = $this->clock->today();
        $this->operations[] = new Withdrawal($date, $amount);
    }

    public function getStatement(){
        $balance = 0;

        $operations = $this->operations;

        $res = '';
        foreach($operations as $operation){
            if ($operation instanceof Deposit){
                $balance += $operation->getAmount();
                $res = PHP_EOL . $operation->getDate() . ' || '. number_format($operation->getAmount(), 2, '.','').' || || '. number_format($balance, 2, '.', '') . $res;

            }
            else{
                $balance -= $operation->getAmount();
                $res = PHP_EOL . $operation->getDate() . ' || || '. number_format($operation->getAmount(), 2, '.','').' || '. number_format($balance, 2, '.', '') . $res;
            }
        }

        $header = 'date || credit || debit || balance';

        return $header . $res;
    }
}