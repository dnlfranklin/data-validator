<?php

/**
 * @method static boolean isValid(mixed $value, string $format = 'Y-m-d')
 */

namespace DataValidator\Field\Type;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Date extends Field{

    public function __construct(private string $format = 'Y-m-d'){}
    
    public function validate($value):bool {
        $date = $this->getDatetime($value);

        if(!$date){
            parent::newError(Translator::translate("Is not a valid date for the format %s", $this->format));   
        
            return false;
        }        
        
        return true;
    }

    private function getDatetime(string $date):?\DateTime {
        $datetime = \DateTime::createFromFormat($this->format, $date);    

        if( $datetime && $datetime->format($this->format) === $date ){
            return $datetime;
        }
        
        return null;
    }    

}