<?php

/**
 * @method static boolean isValid(mixed $value, Array $structure, bool $recursive = false)
 */

namespace DataValidator\Field\Array;

use DataValidator\Field\Field;
use DataValidator\Lang\Translator;

class Multidimensional extends Field{
    

    public function __construct(
        private Array $structure,
        private bool $recursive = false
    ){}       

    public function validate($value):bool {
        if(!is_array($value)){
            parent::newError(Translator::translate('Is not a valid %s', 'Array'));

            return false;
        }
        
        if($this->recursive){
            foreach($value as $data){
                if(!is_array($data)){
                    parent::newError(Translator::translate('Is not a valid %s', 'Array'));
        
                    return false;
                }
            }
            
            foreach($value as $key => $data){
                foreach($this->structure as $structure_key => $structure_item){
                    $this->map($structure_item, $data, [$structure_key], $key);                           
                }
            }
        }
        else{
            foreach($this->structure as $structure_key => $structure_item){
                $this->map($structure_item, $value, [$structure_key]);                           
            }
        }

        return empty(parent::getErrors());
    }

    private function map($structure_item, Array $data, Array $tree = [], $recursive_key = null){
        if(is_array($structure_item)){
            foreach($structure_item as $key => $item){
                $tree_key = $tree;
                $tree_key[] = $key;
                
                $this->map($item, $data, $tree_key, $recursive_key);
            }
        }
        else{
            $pointer_data = &$data;
            
            $tree_string = implode(' > ', $tree);
            $recursive_key_string = is_null($recursive_key) ? '': "[{$recursive_key}]";

            foreach($tree as $tree_level){
                if(empty($pointer_data[$tree_level])){
                    parent::newError(Translator::translate('Attribute \'%s\' not found %s', $tree_string, $recursive_key_string));

                    return;
                }

                $pointer_data = &$pointer_data[$tree_level];
            }

            if($structure_item instanceof Field){
                $structure_item->clear();
                $structure_item->validate($pointer_data);

                foreach($structure_item->getErrors() as $error){
                    parent::newError($tree_string.' > '.$error.$recursive_key_string);
                }

                
            }
        }
    }

}