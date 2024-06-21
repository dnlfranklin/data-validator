<?php

/**
 * @method static boolean isValid(mixed $value, Array $options)
 */

namespace DataValidator\Field\Array;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Enum extends Field{

    public function __construct(private Array $options){}

    public function validate($value):bool {
        if( !in_array($value, $this->options) ){
            parent::newError(Translator::translate("Does not contain a valid option"));   
            
            return false;
        }
        return true;
    }

    public function addOptions(Array $options):void {
        foreach($options as $option){
            $this->options[] = $option;
        }        
    }    

}