<?php

namespace kofo\RouteCommands;

use Illuminate\Support\Facades\Facade;

class RouteCommandsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'route-commands';
    }
}