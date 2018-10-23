<?php

return [
    /*
     * Route prefix for running commands eg
     * http://127.0.0.1:8080/commands
     */
    'route_prefix' => 'commands',

    /*
     * Available routes and their commands
     */
    'routes' => [
        'list' => 'list migrate',
        'migrate' => 'migrate',
        'migrate/force' => 'migrate --force',
        'migrate/rollback' => 'migrate:rollback',
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

    /*
     * Whether route commands should be authenticated
     */
    'authentication' => [
        /*
         * Should there be a password prompt
         */
        'authenticated' => true,
        'display' => 'Enter your password',

        /*
         * NOTE: Command will not run if password is this default
         */
        'pass' => 'FG9cdLwzNTvFvEsR',
    ],

    /*
     * The commands that should not be runnable via routes
     */
    'blocked_commands' => [
        'down',
        'app:name',
        'migrate:refresh',
        'migrate:reset',
        'notifications:table',
        'queue:table',
        'cache:table',
        'session:table',
        'event:generate',
    ],
];