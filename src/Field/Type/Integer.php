<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Type;

class Integer extends VarType{

    public function __construct(){
        parent::__construct('INT');
    }  

}