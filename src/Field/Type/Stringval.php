<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Type;

class Stringval extends VarType{

    public function __construct(){
        parent::__construct('STRING');
    }  

}