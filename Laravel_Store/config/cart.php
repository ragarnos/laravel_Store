<?php

return [


    'calculator' => \Gloudemans\Shoppingcart\Calculation\DefaultCalculator::class,

    'tax' => 5,


    'database' => [

        'connection' => null,

        'table' => 'shoppingcart',

    ],



    'destroy_on_logout' => true,


    'format' => [

        'decimals' => 2,

        'decimal_point' => '.',

        'thousand_separator' => ',',

    ],

];
