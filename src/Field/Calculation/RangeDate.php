<?php

/**
 * @method static boolean isValid(mixed $value, string $min_date = null, string $max_date = null)
 */

namespace DataValidator\Field\Calculation;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class RangeDate extends Field{

    public function __construct(
        private string|null $min_date = null, 
        private string|null $max_date = null
    ){}
    
    public function validate($value):bool {
        $date = strtotime($value);

        if($this->min_date){
            $min_date = strtotime($this->min_date);

            if($date < $min_date){
                parent::newError(Translator::translate("Minimum date accepted is %s", $this->min_date));   
            }            
        }

        if($this->max_date){
            $max_date = strtotime($this->max_date);

            if($date > $max_date){
                parent::newError(Translator::translate("Maximum date accepted is %s", $this->max_date));    
            }               
        }
        
        return empty(parent::getErrors());
    }       

}