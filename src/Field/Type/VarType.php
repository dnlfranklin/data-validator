<?php

/**
 * @method static boolean isValid(mixed $value, string $type)
 */

namespace DataValidator\Field\Type;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class VarType extends Field{

    const AVAILABLE_FILTERS = [
        'ARRAY', 'BOOL', 'BOOLEAN', 'CALLABLE', 'DOMAIN', 'EMAIL', 
        'FLOAT', 'INFINITE', 'INT', 'IP', 'JSON', 'HEX', 
        'MAC', 'NAN', 'NUMERIC', 'OBJECT', 'STRING', 'URL'  
    ];

    public function __construct(private string $type){}
    
    public function validate($value):bool {
        $type = strtoupper($this->type);
        
        switch($type){
            case 'NUMERIC':
                $valid = is_numeric($value);
                break;
            case 'NAN':
                $valid = is_nan($value);
                break;
            case 'INFINITE':
                $valid = is_infinite($value);
                break;
            case 'STRING':
                $valid = is_string($value);
                break;
            case 'BOOLEAN':
            case 'BOOL':
                $valid = is_bool($value);
                break;
            case 'ARRAY':
                $valid = is_array($value);
                break;
            case 'OBJECT':
                $valid = is_object($value);
                break;
            case 'CALLABLE':
                $valid = is_callable($value);
                break;
            case 'FLOAT':
            case 'INT':
            case 'DOMAIN':
            case 'EMAIL':
            case 'IP':
            case 'MAC':
            case 'URL':
                $constant = constant('FILTER_VALIDATE_'.$type);
                $valid = filter_var($value, $constant) === false ? false : true; 
                break;                   
            case 'JSON':
                if( phpversion() >= '8.3.0'){
                    $valid = json_validate($value);
                }
                else{
                    json_decode($value);    
                    $valid = json_last_error() === JSON_ERROR_NONE;
                }
                break;
            case 'HEX':
                $valid = ctype_xdigit($value);                    
                break;
            default:
                $valid = true;
        }

        if(!$valid){
            parent::newError(Translator::translate("Is not a valid %s", $type));   
        }

        return $valid;
    }    

}