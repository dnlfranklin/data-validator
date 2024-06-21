<?php

/**
 * @method static boolean isValid(mixed $value, callable $callable)
 */

namespace DataValidator\Field\Callable;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Custom extends Field{

    public function __construct(private \Closure $callable){}

    public function validate($value):bool {
        if(!call_user_func($this->callable, $value)){
            parent::newError(Translator::translate('Is invalid'));   
            
            return false;
        }
        return true;
    }

}