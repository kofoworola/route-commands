<?php

namespace kofo\RouteCommands\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use kofo\RouteCommands\RouteCommandsFacade;

class RouteCommandsController extends Controller
{

    public function handle(Request $request){
        $value = RouteCommandsFacade::commandString();
        $this->checkExists($value);

        $request->session()->push('commands.value',$value);
        RouteCommandsFacade::setOptions($value);

        if(config('commands.authentication')['authenticated']){
            $request->session()->push('commands.authenticated',false);
            $data['authenticated'] = false;
            $data['command'] = RouteCommandsFacade::command();
            $data['lines'] = [];
            return view('route-commands::console',$data);
        }

        $output = $this->runCommand($value);
        return view('route-commands::console',$output);
    }

    public function authenticate(Request $request){
        $value = RouteCommandsFacade::commandString();

        $this->checkExists($value);

        $pass = config('commands.authentication')['pass'];
        if($value != $request->session()->get('commands.value')[0] || $request->password != $pass
            || $request->password == "FG9cdLwzNTvFvEsR"){
            abort(401);
            return;
        }

        $output = $this->runCommand($value);
        $output['authenticated']= true;
        $request->session()->flush();
        return view('route-commands::console',$output);
    }

    private function runCommand($value){
        RouteCommandsFacade::setOptions($value);
        $output = RouteCommandsFacade::callCommand();
        return $output;
    }

    private function checkExists($value){
        if(!isset($value)){
            abort(404);
            return;
        }
    }





}
