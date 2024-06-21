<?php

/**
 * @method static boolean isValid(mixed $soruce, bool $force_type = false)
 */

namespace DataValidator\Field\Calculation;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class NotEqual extends Field{

    public function __construct(
        private mixed $source, 
        private bool $force_type = false
    ){}

    public function validate($value):bool {
        $valid = $this->force_type ? 
                    $value !== $this->source : 
                    $value != $this->source;
        
        if(!$valid){
            $source = is_array($this->source) || is_object($this->source) ? 
                        serialize($this->source) : 
                        $this->source;

            parent::newError(Translator::translate('Must be different from %s', $source));
        }
        
        return $valid;
    }  

}