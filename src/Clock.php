<?php
/**
 * Created by PhpStorm.
 * User: juanlozano
 * Date: 29/09/16
 * Time: 17:55
 */

namespace BankKata;


class Clock
{

    public function today()
    {
        return (new \DateTime('now'))->format('Y/m/d');
    }

}