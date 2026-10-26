<?php

namespace Moayman\Mvc\Validation\Rules;

use Moayman\Mvc\Validation\Rules\contract\Rule;

class ConfirmedRule implements Rule
{
    public function apply($field, $value, $data)
    {
            return($data[$field]===$data[$field.'_confirmation']);
    }

    public function __tostring()
    {
        return "your %s is not confirmed";
    }


}