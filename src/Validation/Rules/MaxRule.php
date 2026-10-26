<?php
namespace Moayman\Mvc\Validation\Rules;

use Moayman\Mvc\Validation\Rules\contract\Rule;

class MaxRule implements Rule
{
    protected int $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function apply($field, $value, $data)
    {
        return (strlen($value) <= $this->max);
    }

    public function __tostring()
    {
        return "%s must be {$this->max} characters or less";
    }



}