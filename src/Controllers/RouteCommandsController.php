<?php

namespace kofo\RouteCommands\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
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

        $this->checkCommand($options[0]);


        $output = RouteCommandsFacade::callCommand($options);
        return view('route-commands::console',$output);
    }


    private function guessKey($command){
        if(str_contains($command,'make')){
            return 'name';
        }
    }

    private function checkCommand($command){
        if(str_contains($command,'make') || str_contains($command,'session:table'))
            abort(500,'Do not run make of session:table commands from here');
    }
}
