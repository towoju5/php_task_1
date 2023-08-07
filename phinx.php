<?php
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
return [
    'paths'        => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds'      => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => 'development',
        'development'             => [
            'adapter' => 'mysql',
            'host'    => 'localhost',
            'name'    => 'outlineguru_manaknightdigital_co_AQmEXsfd',
            'user'    => 'outlinegurum8q7S',
            'pass'    => 'KztAmFhHueXOPTwWfl5boqaV',
            'port'    => 3306,
            'charset' => 'utf8'
        ]
    ],
];