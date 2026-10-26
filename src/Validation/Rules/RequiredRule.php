<?php
namespace Moayman\Mvc\Validation\Rules;

use Moayman\Mvc\Validation\Rules\contract\Rule;
class RequiredRule implements Rule{
    public function apply($field, $value, $data){
        return !empty($value);
    }

    public function __tostring(){
        return '%s is required and can not be empty';
    }
    
}