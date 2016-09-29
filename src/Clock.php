<?php

namespace KataBank;

class Clock{
    /**
     * @var \DateTimeImmutable
     */
    private static $now;

    public static function now(){
        return static::$now ?: new \DateTimeImmutable();
    }

    /**
     * @param \DateTimeImmutable $now
     */
    public static function setNow(\DateTimeImmutable $now = null){
        static::$now = $now;
    }
}