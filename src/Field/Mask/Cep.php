<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Mask;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Cep extends Field{

    const MASK = '^([0-9]{5}[\-][0-9]{3}|\d{8})$';

    public function validate($value):bool {
        $regex = self::MASK;

        if( !preg_match("/{$regex}/", $value) ){
            parent::newError(Translator::translate("Does not contain a valid %s mask", 'CEP'));
            
            return false;
        }            
        
        return true;
    }    

}