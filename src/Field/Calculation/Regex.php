<?php

/**
 * @method static boolean isValid(mixed $value, string $regex)
 */

namespace DataValidator\Field\Calculation;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Regex extends Field{

    public function __construct(private string $regex){}

    public function validate($value):bool {
        if( !preg_match("/{$this->regex}/", $value) ){
            parent::newError(Translator::translate("Does not contain the required valid pattern"));   
            
            return false;
        }
        return true;
    }

    public function setRegex(string $regex){
        $this->regex = $regex;
    }    

}