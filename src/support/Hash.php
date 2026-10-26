<?php

namespace Moayman\Mvc\Support;

class Hash
{
    public static function password($value)
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    public static function verify($value, $hashed_value)
    {
        return password_verify($value, $hashed_value);
    }

    public static function make($value)
    {
        return sha1($value, time());
    }

    

}