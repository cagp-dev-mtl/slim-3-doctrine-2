<?php
return [
    'settings' => [
        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'app/src/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => '**YOUR_HOST_IP**',
                'dbname'   => '**YOUR_DB_NAME**',
                'user'     => '**YOUR_DB_USERNAME**',
                'password' => '**YOUR_DB_PASSWORD**',
            ]
        ],
        'stormpath' => [
            'api_base_url'          => 'https://api.stormpath.com/v1/',
            'application_endpoint'  => '**STORMPATH_APPLICATION_ENDPOINT**',
            'directory_href'        => '**STORMPATH_DIRECTORY_HREF**',
            'api_key_file'          => '**LOCAL_API_KEY**',
            'users_directory_id'    => '**STORMPATH_DIRECTORY_ID**'
        ]
    ],
];
