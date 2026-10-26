<?php

namespace Moayman\Mvc\Validation;

use Moayman\Mvc\Validation\Rules\AlphanumRule;
use Moayman\Mvc\Validation\Rules\BetweenRule;
use Moayman\Mvc\Validation\Rules\ConfirmedRule;
use Moayman\Mvc\Validation\Rules\EmailRule;
use Moayman\Mvc\Validation\Rules\MaxRule;
use Moayman\Mvc\Validation\Rules\RequiredRule;
use Moayman\Mvc\Validation\Rules\UniqueRule;

class RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'alnum' => AlphanumRule::class,
        'max' => MaxRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
        'confirmed' => ConfirmedRule::class,
        'unique'=> UniqueRule::class
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }

}