<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Mask;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Uuid extends Field{

    const MASK = '^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$';

    public function validate($value):bool {
        $regex = self::MASK;

        if( !preg_match("/{$regex}/", $value) ){
            parent::newError(Translator::translate("Does not contain a valid %s mask", 'UUID'));
            
            return false;
        }            
        
        return true;
    }    

}