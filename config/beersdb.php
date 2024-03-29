<?php

return [
    'client_options' => [
        'base_uri' => 'https://api.brewerydb.com/v2/',
    ],
    'request_options' => [
        'query' => [
            'format' => 'json',
            'key'    => getenv('BREWERYDB_KEY'),
        ],
    ],
    'twig' => [
        'templatesPath' => __DIR__.'/../templates/twig',
        'cache'         => __DIR__.'/../storage/templates/twig',
    ],
];
