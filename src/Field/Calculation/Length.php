<?php

/**
 * @method static boolean isValid(mixed $value, int $min = 0, int $max = null)
 */

namespace DataValidator\Field\Calculation;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Length extends Field{

    public function __construct(private int $min = 0, private ?int $max = null){}

    public function validate($value):bool {
        $len = strlen($value);
        
        if( $len < $this->min) {
            parent::newError(Translator::translate("Requires a minimum of %s characters", $this->min));   
        }

        if( !empty($this->max) && $len > $this->max) {
            parent::newError(Translator::translate("Allows a maximum of %s characters", $this->max));   
        }

        return empty(parent::getErrors());
    }

    public function setMin(int $min):void {
        $this->min = $min;
    }

    public function setMax(?int $max):void {
        $this->max = $max;
    }    

}