<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Mask;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class PhoneE1641 extends Field{

    const MASK = '^\+[1-9][0-9]\d{1,14}$';

    public function validate($value):bool {
        $regex = self::MASK;

        if( !preg_match("/{$regex}/", $value) ){
            parent::newError(Translator::translate("Does not contain a valid %s mask", 'PHONE_E1641'));
            
            return false;
        }            
        
        return true;
    }    

}