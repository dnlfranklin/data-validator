<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Type;

class Floatval extends VarType{

    public function __construct(){
        parent::__construct('FLOAT');
    }  

}