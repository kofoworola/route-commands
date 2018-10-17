<?php

namespace kofo\RouteCommands\Controllers;

use Illuminate\Routing\Controller;
use kofo\RouteCommands\RouteCommandsFacade;

class RouteCommandsController extends Controller
{

    public function handle(){
        $route = RouteCommandsFacade::afterPrefix();
        $config_routes = config('commands.routes');
        $value =$config_routes[$route];
        if(!isset($value)){
            echo 'it does not exist';
            abort(404);
        }
        $options = RouteCommandsFacade::allOptions($value);

        $output = RouteCommandsFacade::callCommand($options);
        return view('route-commands::console',$output);
    }



}
