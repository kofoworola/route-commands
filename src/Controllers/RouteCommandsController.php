<?php

namespace kofo\RouteCommands\Controllers;

use function foo\func;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;

class RouteCommandsController extends Controller
{

    public function handle(){
        $route = get_path_after_prefix();
        $config_routes = config('commands.routes');
        $value =$config_routes[$route];
        if(!isset($value)){
            echo 'it does not exist';
            abort(404);
        }
        $options = generate_all_options($value);

        $this->checkCommand($options[0]);

        Artisan::call($options[0],$options);
        return Artisan::output();
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
