<?php

namespace DataValidator\Field;


abstract class Field{

    private $errors = [];

    abstract public function validate(mixed $value):bool;

    final public function getErrors():Array {
        return $this->errors;    
    }  

    final public function clear():void {
        $this->errors = [];
    }

    final protected function newError(string $message):void {
        $this->errors[] = $message;
    }

    final public static function __callStatic($method, $arguments):bool {
        if($method == 'isValid'){
            if(empty($arguments)){
                throw new \InvalidArgumentException('Argument #1($value) is required');
            }

            $value = array_shift($arguments);

            $rc = new \ReflectionClass(static::class);
            $field = $rc->newInstanceArgs($arguments);
            
            return $field->validate($value);
        }
    }

}