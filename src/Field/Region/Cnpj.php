<?php

/**
 * @method static boolean isValid(mixed $value, bool $mask = true)
 */

namespace DataValidator\Field\Region;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Cnpj extends Field{

    public function __construct(private bool $mask = true){}

    public function validate($value):bool {
        try {
            if( !$this->mask && !ctype_digit($value)){
                throw new \Exception("Only accepts numbers");
            }
            
            if($this->mask && !ctype_digit($value) && !preg_match("/[0-9]{2}[\.][0-9]{3}[\.][0-9]{3}[\/][0-9]{4}[-][0-9]{2}/", $value)) {
                throw new \Exception("Is not a valid %s");
            }
    
            $cnpj = preg_replace( "@[./-]@", "", $value );
            if(strlen( $cnpj ) <> 14 or !is_numeric($cnpj)){
                throw new \Exception("Is not a valid %s");
            }

            $k = 6;
            $soma1 = 0;
            $soma2 = 0;
            for($i = 0; $i < 13; $i++){
                $k = $k == 1 ? 9 : $k;
                $soma2 += ( substr($cnpj, $i, 1) * $k );
                $k--;
                if($i < 12)
                {
                    if($k == 1)
                    {
                        $k = 9;
                        $soma1 += ( substr($cnpj, $i, 1) * $k );
                        $k = 1;
                    }
                    else
                    {
                        $soma1 += ( substr($cnpj, $i, 1) * $k );
                    }
                }
            }
            
            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
            
            $valid = ( substr($cnpj, 12, 1) == $digito1 and substr($cnpj, 13, 1) == $digito2 );
            
            if (!$valid){
                throw new \Exception("Is not a valid %s");
            }
    
            return true;
        }
        catch(\Exception $e){
            parent::newError(Translator::translate($e->getMessage(), 'CNPJ'));

            return false;
        }
    }

}