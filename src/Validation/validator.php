<?php
namespace Moayman\Mvc\Validation;
use Moayman\Mvc\Validation\Errorbag;
use Moayman\Mvc\Validation\Message;
use Moayman\Mvc\Validation\Rules\AlphanumRule;
use Moayman\Mvc\Validation\Rules\BetweenRule;
use Moayman\Mvc\Validation\Rules\MaxRule;
use Moayman\Mvc\Validation\Rules\RequiredRule;
use Moayman\Mvc\Validation\Rules\contract\Rule;
class validator
{
    protected $data = [];
    protected $rules = [];
    protected $aliases = [];
    protected Errorbag $errorbag;


    public function make($data)
    {
        $this->data = $data;
        $this->errorbag = new Errorbag();
        $this->validate();
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach (RulesResolver::make($rules) as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

    protected function applyRule($field, Rule $rule)
    {
        if (!$rule->apply($field, $this->getFieldValue($field), $this->data)) {
            $this->errorbag->add($field, Message::generate($rule, $this->alias($field)));
        }
    }




    public function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }


    public function setrules($rules)
    {
        $this->rules = $rules;
    }

    public function passes()
    {
        return empty($this->errors());
    }

    public function errors($key = null)
    {
        return $key ? $this->errorbag->errors[$key] : $this->errorbag->errors;
    }

    public function alias($field)
    {
        return $this->aliases[$field] ?? $field;
    }

    public function setaliases(array $aliases)
    {
        $this->aliases = $aliases;
    }



}