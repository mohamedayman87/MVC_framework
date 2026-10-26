<?php

namespace Moayman\Mvc\Validation\Rules\contract;

interface Rule
{
    public function apply($field, $value, $data);
    public function __tostring();
}