<?php

return [
    /*
     * Route prefix for running commands eg
     * http://127.0.0.1:8080/commands
     */
    'route_prefix' => 'commands',

    /*
     * Available routes and their commands
     * NOTE do not use in the form of /do/something instead use /do_something
     */
    'routes' => [
        'migrate' => 'migrate',
        'migrate/force' => 'migrate --force',
        'migrate/rollback' => 'migrate:rollback',
        'migrate/refresh' => 'migrate:refresh',
        'config_cache' => 'config:cache',
        'route_list' => 'route:list',
        'queue_work' => 'queue:work --once',
        'db_seed' => 'db:seed',
        'key_generate' => 'key:generate',
        'optimize_clear' => 'optimize_clear',
        'package_discover' => 'package:discover',
        'queue_failed' => 'queue:failed',
        'storage_link' => 'storage:link',
        'vendor/publish' => 'vendor:publish --all',
        'view_cache' => 'view:cache',

    ],

    'blocked_commands' => [
        'down',
        'app:name',
        'migrate:refresh',
        'migrate:reset',
        'notifications:table',
        'queue:table',
    ]
];