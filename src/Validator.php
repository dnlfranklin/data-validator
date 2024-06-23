<?php

/**
 * @method Validator enum(string $fieldname, Array $options)
 * 
 * @method Validator multidimensional(string $fieldname, Array $structure, bool $recursive = false)
 * 
 * @method Validator not_in(string $fieldname, Array $options)
 * 
 * @method Validator equal(string $fieldname, bool $force_type = false)
 * 
 * @method Validator length(string $fieldname, int $min = 0, int|null $max = null)
 * 
 * @method Validator not_empty(string $fieldname)
 * 
 * @method Validator not_equal(string $fieldname, bool $force_type = false)
 * 
 * @method Validator range(string $fieldname, int|float|null $min = null, int|float|null $max = null)
 * 
 * @method Validator range_date(string $fieldname, string $min_date = null, string $max_date = null)
 * 
 * @method Validator regex(string $fieldname, string $regex)
 * 
 * @method Validator custom_validation(string $fieldname, callable $callable_validation)
 * 
 * @method Validator mask_cep(string $fieldname)
 * 
 * @method Validator mask_phone(string $fieldname)
 * 
 * @method Validator mask_phone_E1641(string $fieldname)
 * 
 * @method Validator mask_uuid(string $fieldname)
 * 
 * @method Validator cpf(string $fieldname, bool $allow_mask = true)
 * 
 * @method Validator cnpj(string $fieldname, bool $allow_mask = true)
 * 
 * @method Validator date(string $fieldname, $format = 'Y-m-d')
 * 
 * @method Validator array(string $fieldname)
 * 
 * @method Validator bool(string $fieldname)
 * 
 * @method Validator boolean(string $fieldname)
 * 
 * @method Validator callable(string $fieldname)
 * 
 * @method Validator email(string $fieldname)
 * 
 * @method Validator float(string $fieldname)
 *
 * @method Validator int(string $fieldname)
 * 
 * @method Validator integer(string $fieldname)
 *
 * @method Validator ip(string $fieldname)
 * 
 * @method Validator json(string $fieldname)
 * 
 * @method Validator hex(string $fieldname)
 * 
 * @method Validator mac(string $fieldname)
 * 
 * @method Validator numeric(string $fieldname, $allow_options = ['integer', 'float', 'infinite', 'nan', 'number_string', 'negative'])
 * 
 * @method Validator object(string $fieldname)
 * 
 * @method Validator string(string $fieldname)
 * 
 * @method Validator url(string $fieldname)
 * 
 * @method Validator not_array(string $fieldname)
 * 
 * @method Validator not_bool(string $fieldname)
 * 
 * @method Validator not_boolean(string $fieldname)
 * 
 * @method Validator not_callable(string $fieldname)
 * 
 * @method Validator not_email(string $fieldname)
 * 
 * @method Validator not_float(string $fieldname)
 *
 * @method Validator not_int(string $fieldname)
 * 
 * @method Validator not_integer(string $fieldname)
 *
 * @method Validator not_ip(string $fieldname)
 * 
 * @method Validator not_json(string $fieldname)
 * 
 * @method Validator not_hex(string $fieldname)
 * 
 * @method Validator not_mac(string $fieldname)
 * 
 * @method Validator not_numeric(string $fieldname, $allow_options = ['integer', 'float', 'infinite', 'nan', 'number_string', 'negative'])
 * 
 * @method Validator not_object(string $fieldname)
 * 
 * @method Validator not_string(string $fieldname)
 * 
 * @method Validator not_url(string $fieldname)
 */

namespace DataValidator;


class Validator{

    const ALIAS = [
        'enum'              => ['field' => \DataValidator\Field\Array\Enum::class],
        'multidimensional'  => ['field' => \DataValidator\Field\Array\Multidimensional::class],
        'not_in'            => ['field' => \DataValidator\Field\Array\NotIn::class],
        'equal'             => ['field' => \DataValidator\Field\Calculation\Equal::class],
        'length'            => ['field' => \DataValidator\Field\Calculation\Length::class],
        'not_empty'         => ['field' => \DataValidator\Field\Calculation\NotEmpty::class],
        'not_equal'         => ['field' => \DataValidator\Field\Calculation\NotEqual::class],
        'range'             => ['field' => \DataValidator\Field\Calculation\Range::class],
        'range_date'        => ['field' => \DataValidator\Field\Calculation\RangeDate::class],
        'regex'             => ['field' => \DataValidator\Field\Calculation\Regex::class],
        'custom_validation' => ['field' => \DataValidator\Field\Callable\Custom::class],
        'mask_cep'          => ['field' => \DataValidator\Field\Mask\Cep::class],
        'mask_phone'        => ['field' => \DataValidator\Field\Mask\Phone::class],
        'mask_phone_E1641'  => ['field' => \DataValidator\Field\Mask\PhoneE1641::class],
        'mask_uuid'         => ['field' => \DataValidator\Field\Mask\Uuid::class],
        'cpf'               => ['field' => \DataValidator\Field\Region\Cpf::class],
        'cnpj'              => ['field' => \DataValidator\Field\Region\Cnpj::class],
        'date'              => ['field' => \DataValidator\Field\Type\Date::class],
        'array'             => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['array']],
        'bool'              => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['bool']],
        'boolean'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['boolean']],
        'callable'          => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['callable']],
        'email'             => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['email']],
        'float'             => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['float']],
        'int'               => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['int']],
        'integer'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['int']],
        'ip'                => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['ip']],
        'json'              => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['json']],
        'hex'               => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['hex']],
        'mac'               => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['mac']],
        'numeric'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['numeric']],
        'object'            => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['object']],
        'string'            => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['string']],
        'url'               => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['url']],
        'not_array'         => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['array', true]],
        'not_bool'          => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['bool', true]],
        'not_boolean'       => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['boolean', true]],
        'not_callable'      => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['callable', true]],
        'not_email'         => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['email', true]],
        'not_float'         => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['float', true]],
        'not_int'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['int', true]],
        'not_integer'       => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['int', true]],
        'not_ip'            => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['ip', true]],
        'not_json'          => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['json', true]],
        'not_hex'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['hex', true]],
        'not_mac'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['mac', true]],
        'not_numeric'       => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['numeric', true]],
        'not_object'        => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['object', true]],
        'not_string'        => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['string', true]],
        'not_url'           => ['field' => \DataValidator\Field\Type\VarType::class, 'params' => ['url', true]],
    ];

    private $validations = [];
    private $errors = [];


    public function getErrors(){
        return $this->errors;    
    }

    public function getFirstError(){
        if( !empty($this->getErrors()) ){
            return $this->getErrors()[0];
        }
    }

    public function getLastError(){
        if( !empty($this->getErrors()) ){
            return end($this->getErrors());
        }
    }

    public function add(string $fieldname, \DataValidator\Field\Field $validator){
        $this->validations[] = [
            'fieldname' => $fieldname,
            'validator' => $validator
        ]; 

        return $this;
    }

    public function addConditional(
        string $conditional_fieldname, 
        \DataValidator\Field\Field $conditional_validator, 
        string $fieldname,
        \DataValidator\Field\Field $validator
    ){
        $this->validations[] = [
            'conditional_fieldname' => $conditional_fieldname,
            'conditional_validator' => $conditional_validator,
            'fieldname' => $fieldname,
            'validator' => $validator
        ];

        return $this;
    }

    public function validate(Array|object $data){
        if( is_array($data) ){
            $data = (object) $data;
        }
        
        foreach($this->validations as $validation){
            $fieldname = $validation['fieldname']; 
            $validator = $validation['validator'];

            if(isset($validation['conditional_fieldname'])){
                $conditional_fieldname = $validation['conditional_fieldname'];    
                $conditional_validator = $validation['conditional_validator'];
                
                if(property_exists($data, $conditional_fieldname)){
                    if(!$conditional_validator->validate($data->{$conditional_fieldname})){
                        continue;
                    }
                }
            }

            if(!property_exists($data, $fieldname)){
                $this->errors[] = \DataValidator\Error::new(
                    $fieldname, 
                    \DataValidator\Lang\Translator::translate('Field not sent in data')
                );

                continue;
            }
                
            if(!$validator->validate($data->{$fieldname})){
                foreach($validator->getErrors() as $error){
                    $this->errors[] = \DataValidator\Error::new($fieldname, $error);
                }
            }             
        }

        return empty($this->getErrors());
    }

    public function __call(string $method, Array $args){
        if(!array_key_exists($method, self::ALIAS)){
            throw new \Exception("Method {$method} does not exists.");
        }

        if(empty($args)){
            throw new \Exception("Argument #1 (fieldname) is required for {$method}.");         
        }

        $fieldname = array_shift($args);

        $alias = self::ALIAS[$method];
        
        $params = empty($alias['params']) ? $args : $alias['params'];
            
        $classname = $alias['field'];

        $rc = new \ReflectionClass($classname);
        $field = $rc->newInstanceArgs($params);

        $this->add($fieldname, $field);

        return $this;
    }

}