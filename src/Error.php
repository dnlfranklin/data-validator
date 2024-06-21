<?php

namespace DataValidator;

use DataValidator\Lang\Translator;

class Error {

    private static $throw_on_new = true;

    public $field;
    public $message;

    const FIELD_ALIAS = [
        '{$field}',
        '{$1}'
    ];

    public static function throw(bool $option){
        self::$throw_on_new = $option;
    }

    public static function new(string $field, string $message):Error {
        $error = new self;

        $error->field = $field;
        $error->message = str_replace(self::FIELD_ALIAS, $field, $message);
        
        if(self::$throw_on_new){
            throw new \Exception(Translator::translate('Attribute \'%s\' is invalid: %s', $error->field, $error->message));
        }

        return $error;
    }

}