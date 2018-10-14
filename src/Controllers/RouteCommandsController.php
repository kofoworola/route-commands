<?php

namespace kofo\RouteCommands\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Output\StreamOutput;

class RouteCommandsController extends Controller
{
    public function handle(){
        $route = $this->getAfterPrefix(Request::path());
        $config_routes = config('commands.routes');
        if(!array_key_exists($route,$config_routes)){
            abort(404);
        }

        $value =$config_routes[$route];
        $options = [];
        if(is_array($value)){
            $command = $value['command'];
            $options = $value['options'];
            echo print_r($options);
        }
        else{
            $command = $value;
        }

        $options = $this->fix_options($options);

        $stream = fopen("php://output", "w");
        Artisan::call($command,$options,new StreamOutput($stream));
        return var_dump($stream);
    }

    private function getAfterPrefix($route){
        return str_after($route,config('commands.route_prefix').'/');
    }

    private function fix_options($options){
        $fixed = [];
        foreach ($options as $key => $value){
            if(is_int($key)){
                $fixed[$value] = true;
            }
            else{
                $fixed[$key] = $value;
            }
        }
        return $fixed;
    }
}
