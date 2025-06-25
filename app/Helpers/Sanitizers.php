<?php

namespace App\Helpers;

class Sanitizers
{
    public static function alphanumeric($value)
    {
        return preg_replace("/[^[:alnum:]]/", '', $value);
    }
}
