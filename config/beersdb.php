<?php

return [
    'client_options' => [
        'base_uri' => 'https://api.brewerydb.com/v2/',
    ],
    'request_options' => [
        'query' => [
            'format' => 'json',
            'key' => get_env('BREVERY_DB_KEY'),
        ],
    ],
    'twig' => [
        'templatesPath' => __DIR__ . '/../templates',
        'cache' => __DIR__ . '/../storage/templates',
    ],
];
