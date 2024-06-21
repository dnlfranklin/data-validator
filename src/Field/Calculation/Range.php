<?php

/**
 * @method static boolean isValid(mixed $value, int|float|null $min = null, int|float|null $max = null)
 */

namespace DataValidator\Field\Calculation;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Range extends Field{

    public function __construct(
        private int|float|null $min = null, 
        private int|float|null $max = null
    ){}

    public function validate($value):bool {
        if( !is_numeric($value) ){
            parent::newError(Translator::translate("Must be numeric"));   
            
            return false;
        }

        if($this->min && $value < $this->min) {
            parent::newError(Translator::translate("Requires %s as minimum value", $this->min));   
        }

        if($this->max && $value > $this->max) {
            parent::newError(Translator::translate("Allows %s as maximum value", $this->max));   
        }

        return empty(parent::getErrors());
    }

    public function setMin(int|float|null $min):void {
        $this->min = $min;
    }

    public function setMax(int|float|null $max):void {
        $this->max = $max;
    }    

}