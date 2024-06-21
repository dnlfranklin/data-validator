<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Type;

class Json extends VarType{

    public function __construct(){
        parent::__construct('JSON');
    }  

}