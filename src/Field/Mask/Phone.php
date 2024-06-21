<?php

/**
 * @method static boolean isValid(mixed $value)
 */

namespace DataValidator\Field\Mask;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Phone extends Field{

    const MASK = '^((\+?\d{1,3})(\(\d{1,3}\)|\d{1,3})((\d{3,5})-?(\d{4}))|(\(\d{2}\)|\d{2})?(?:((?:9\d|[2-9])\d{3})-?(\d{4})))$';

    public function validate($value):bool {
        $regex = self::MASK;

        if( !preg_match("/{$regex}/", $value) ){
            parent::newError(Translator::translate("Does not contain a valid %s mask", 'PHONE'));
            
            return false;
        }            
        
        return true;
    }    

}