# Data Validator

Biblioteca para validadação de dados.

## Instalação

Para instalar esta dependência através do [Composer](https://getcomposer.org/).
```shell
composer require bonuscred/data-validator
```

## Utilização

```php
$data = [
    'field_cnpj'   => '81.287.353/0001-16',
    'field_cpf'    => '124.784.370-07',
    'field_int'    => 123,
    'field_string' => 'minhastring',
    'field_date'   => '2024-01-01 00:00:00'
];

$validator = new DataValidator\Validator;
$validator->cnpj('field_cnpj');
$validator->cpf('field_cpf');
$validator->integer('field_int');
$validator->string('field_string');
$validator->date('field_date', 'Y-m-d H:i:s');

$validator->validate($data); //true
```

### Validação direta de atributo
```php
DataValidator\Field\Region\Cpf::isValid('124.784.370-07'); //true
DataValidator\Field\Array\Enum::isValid('a', ['b', 'c']); //false
```

### Tratando Exceções

O comportamento padrão do DataValidator\Validator é disparar uma exceção após encontrar uma dado inválido, é possível evitar esse comportamento e receber como retorno uma valor boleano da validação.

```php
//Evita disparo de Exception
DataValidator\Error::throw(false);

$data = [
    'field_cpf'    => 'not-a-cpf'
    'field_date'   => 'not-a-date'
];

$validator = new DataValidator\Validator;
$validator->cpf('field_cpf');
$validator->date('field_date');

if(!$validator->validate($data)){
    $errors = $validator->getErrors(); //Array contendo todos os erros de validação

    echo $validator->getLastError()->field; //field_date
    echo ': ';
    echo $validator->getLastError()->message; //Mensagem de data inválida
}
```

### Concatenação de métodos

É possivel concatenar todos os métodos de validação do DataValidator\Validator.
```php
(new DataValidator\Validator)->cnpj('field_cnpj')
                             ->cpf('field_cpf')
                             ->integer('field_int')
                             ->string('field_string')
                             ->date('field_date', 'Y-m-d H:i:s')
                             ->validate($data);
```

### Estruturas complexas

DataValidator é capaz de validar estruturas complexas de dados através do componente DataValidator\Field\Array\Multidimensional. 

O segundo parâmetro recebido é um boleano que informa se a estrutura se refere a um array identado simples ou um array de objetos ("Array de arrays").

Ele trabalha de forma recursiva, portanto é possivel passar componentes multidimensionais dentro de outro componente multidimensional, criando uma estrutura complexa e não linear de dados.

```php
$data = [
    'field_int' => 123,
    'complex'   => [
        'a' => 'not-empty',
        'b' => [
            'ba' => 1,
            'bb' => 'is-string',
        ],
        'c' => [
            [
                'ca' => 1,
                'cb' => 'cb_a'
            ],
            [
                'ca' => 2,
                'cb' => 'cb_b'
            ]
        ]
    ]
];


$validator = new DataValidator\Validator;
$validator->integer('field_int')
          ->multidimensional('complex', [
            'a' => new DataValidator\Field\Calculation\NotEmpty,
            'b' => [
                'ba' => new DataValidator\Field\Type\Integer,
                'bb' => new DataValidator\Field\Type\Stringval                
            ],
            'c' => new DataValidator\Field\Array\Multidimensional([
                'ca' => new DataValidator\Field\Type\Integer,
                'cb' => new DataValidator\Field\Array\Enum(['cb_a', 'cb_b'])
            ], true)
          ]);

$validator->validate($data); //true
```

### Validações condicionais

É possivel passar validações condicionais, onde uma validação só será considerada se outra validação for correspondida.
```php
$validator->integer('field_int')
          ->addConditional(
            'field_int',
            new DataValidator\Field\Calculation\Equal(123), 
            'field_condicional', 
            new DataValidator\Field\Calculation\NotEmpty
         );

$validator->validate(['field_int' => 321]); //true
$validator->validate(['field_int' => 123]); //false
```

### Componentes validadores

| Alias | Classe | Descrição |
|-------|--------|-----------|
|enum|DataValidator\Field\Array\Enum|Valida se valor existe dentro de um array de opções|
|multidimensional|DataValidator\Field\Array\Multidimensional|Valida um conjunto de regras definidas a partir de um array multi dimensional|
|notIn|DataValidator\Field\Array\NotIn|Valida se o valor não existe dentro de um array de opções|
|equal|DataValidator\Field\Calculation\Equal|Valida se o valor é igual a um valor de referência|
|length|DataValidator\Field\Calculation\Length|Valida o número de caracteres de uma string|
|notEmpty|DataValidator\Field\Calculation\NotEmpty|Valida se o valor não é vazio|
|notEqual|DataValidator\Field\Calculation\NotEqual|Valida se o valor não é igual a um valor de referência|
|range|DataValidator\Field\Calculation\Range|Valida se o valor está dentro de uma faixa de valores|
|range_date|DataValidator\Field\Calculation\RangeDate|Valida se a data está dentro de uma faixa de datas|
|regex|DataValidator\Field\Calculation\Regex|Valida se o valor atende uma regex estabelecida|
|custom_validation|DataValidator\Field\Callable\Custom|Valida o valor de acordo com uma função anônima definida|
|mask_cep|DataValidator\Field\Mask\Cep|Valida se valor possui a formatação de CEP|
|mask_phone|DataValidator\Field\Mask\Phone|Valida se o valor possui a formatação de telefone|
|mask_phone_E16417|DataValidator\Field\Mask\PhoneE1641|Valida se o valor possui a formatação de telefone no padrão E16417|
|mask_uuid|DataValidator\Field\Mask\Uuid|Valida se o valor contém uma formatação de UUID|
|cpf|DataValidator\Field\Region\Cpf|Valida se o valor é um CPF|
|cnpj|DataValidator\Field\Region\Cnpj|Valida se o valor é um CNPJ|
|date|DataValidator\Field\Type\Date|Valida se o valor é uma data no formato estabelecido|
|array|DataValidator\Field\Type\VarType|Valida se o valor é um array|
|bool|DataValidator\Field\Type\VarType|Valida se o valor é um boleano|
|boolean|DataValidator\Field\Type\VarType|Valida se o valor é um boleano|
|callable|DataValidator\Field\Type\VarType|Valida se o valor é uma função executável |
|email|DataValidator\Field\Type\VarType|Valida se o valor é um email|
|float|DataValidator\Field\Type\VarType|Valida se o valor é um float|
|int|DataValidator\Field\Type\VarType|Valida se o valor é um inteiro|
|integer|DataValidator\Field\Type\VarType|Valida se o valor é um inteiro|
|ip|DataValidator\Field\Type\VarType|Valida se o valor é um ip|
|json|DataValidator\Field\Type\VarType|Valida se o valor é um json|
|hex|DataValidator\Field\Type\VarType|Valida se o valor é um hexadecimal|
|mac|DataValidator\Field\Type\VarType|Valida se o valor é um endereço mac|
|numeric|DataValidator\Field\Type\VarType|Valida se o valor é numérico|
|object|DataValidator\Field\Type\VarType|Valida se o valor é um objeto|
|string|DataValidator\Field\Type\VarType|Valida se o valor é uma string|
|url|DataValidator\Field\Type\VarType|Valida se o valor é uma url|

### Negação

É possível obter uma validação de negação através do prefixo "not_". Nesse caso se o campo tiver uma validação verdadeira, será revertida como falsa.

```php
$validator->integer('field_int')->validate(['field_int' => 123]); //true
$validator->not_integer('field_int')->validate(['field_int' => 123]); //false
```


### Tradução

Atualmente o componente fornece mensagens de erro nos idiomas português(pt-br) e inglês(en), tendo como padrão o pt-br, podendo ser alterado de acordo com o desejado.

```php
DataValidator\Lang\Translator::set('en');
```

## Requisitos
- PHP 8.0 ou superior