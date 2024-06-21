<?php

namespace DataValidator\Lang;

class Translator{

    const PROVIDERS = [
        'en'    => \DataValidator\Lang\Provider\En::class,
        'pt-br' => \DataValidator\Lang\Provider\PtBr::class
    ];

    private static $lang = 'pt-br';

    
    public static function set(string $lang){
        if(array_key_exists($lang, self::PROVIDERS)){
            self::$lang = $lang;
        }
    }

    public static function translate(string $sentence, ?string ...$vars):string {
        $provider = self::PROVIDERS[self::$lang];
        
        $args = [
            'sentence' => $provider::SENTENCES[$sentence] ?? $sentence
        ];
        
        if(!empty($vars)){
            $args+= $vars;
        }

        return call_user_func_array('sprintf', array_values($args));
    }
    

}