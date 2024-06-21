<?php

use DataValidator\Container;
use DataValidator\Field\Array\Enum;
use DataValidator\Field\Array\Multidimensional;
use DataValidator\Field\Calculation\Equal;
use DataValidator\Field\Calculation\NotEmpty;
use DataValidator\Field\Region\Cpf;
use DataValidator\Field\Type\Floatval;
use DataValidator\Field\Type\Integer;
use DataValidator\Field\Type\Stringval;

require '../vendor/autoload.php';

$request = [
    'meuint'      => 123,
    'minhastring' => '123',
    'minhadata'   => '2024-01-01',
    'meucpf'      => '06274928430',
    'meucnpj'     => '76495345000125',
    'multi'       => [
        'a' => 1,
        'b' => [
            'ba' => '1',
            'bb' => '2',
            'bc' => '06274928430',
            'bd' => [
                'bda' => '1a',
                'bdb' =>2,
                'bdc' => [
                    'bdca' => 3,
                    'bdcb' => 4,
                ]
            ],
        ],
        'c' => [
            [
                'ca' => '1a',
                'cb' => '2a',
                'cc' => '3a'
            ],
            [
                'ca' => '1a',
                'cb' => 1,
                'cc' => 1
            ]
        ]
    ]
];

//Impede que seja disparado um Exception após validações mal sucedidas
DataValidator\Error::throw(false);

$container = new Container;
$container->cnpj('meucnpj')
          ->cpf('meucpf')
          ->integer('meuint')
          ->string('minhastring')
          ->date('minhadata', 'Y-m-d')
          ->range_date('minhadata', '2024-01-01', '2024-12-31')
          ->addConditional('meuint', new Equal(123), 'meucpf', new Enum(['60047908009']))
          ->multidimensional('multi', [
                'a' => new NotEmpty,
                'b' => [
                    'ba' => new Integer,
                    'bb' => new Stringval,
                    'bc' => new Cpf,
                    'bd' => [
                        'bda' => new Floatval,
                        'bdb' => new Integer,
                        'bdc' => [
                            'bdca' => new Floatval,
                            'bdcb' => new Stringval,
                        ]
                    ],
                ],
                'c' => new Multidimensional([
                    'ca' => new Integer,
                    'cb' => new Integer,
                    'cc' => new Integer    
                ], true),
            ]
);

$container->validate($request);

var_dump($container->getErrors());