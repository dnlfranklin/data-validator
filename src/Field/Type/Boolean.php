<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Type;

class Boolean extends VarType{

    public function __construct(){
        parent::__construct('BOOLEAN');
    }  

}