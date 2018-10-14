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
        'migrate_force' => 'migrate --force',
    ]
];