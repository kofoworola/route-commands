<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/16/18
 * Time: 6:39 PM
 */

namespace kofo\RouteCommands;


use Illuminate\Support\Facades\Artisan;

class RouteCommands
{
    private $options;

    /**
     * Get the url path after the set prefix
     * @param string $path
     * @return string
     */
    public function afterPrefix($path = ''){
        if(is_null($path) || $path == ''){
            $path = \Illuminate\Support\Facades\Request::path();
        }
        return str_after($path,config('commands.route_prefix').'/');
    }

    public function commandString(){
        $route = $this->afterPrefix();
        $config_routes = config('commands.routes');
        $value =$config_routes[$route];
        return $value;
    }

    /**
     * Generate array item for specific option/arguments
     * @param $option
     * @return array
     */
    public function optionPair($option,$command = '',$count = 1){
        $pair = [];
        if(str_contains($option,['-','--'])){
            if(str_contains($option,'=')){
                $split = explode('=',$option);
                $pair['key'] = $split[0];
                $pair['value'] = $split[1];
            }
            else{
                $pair['key'] = $option;
                $pair['value'] = true;
            }
        }
        else{
            $pair['key'] = $this->guessKey($command,$count);
            $pair['value']= $option;
        }
        return $pair;
    }

    /**
     * Generate all array items based on command string
     * @param $string
     */
    public function setOptions($string){
        $words = explode(' ',$string);
        $options[0] = $words[0];
        if(count($words) > 1)
        {
            for($i=1;$i<count($words);$i++){
                $pair = $this->optionPair($words[$i],$options[0],$i);
                $options[$pair['key']] = $pair['value'];
            }

        }
        $this->options = $options;
    }

    public function command(){
        return $this->options[0];
    }

    /**
     * Try to guess argument keyname
     * @param $command
     * @return string
     */
    public function guessKey($command,$count){
        switch ($command){
            case 'list':
                return 'namespace';
            case 'app:name':
                return 'name';
            case 'cache:forget':
                if($count == 1){
                    return 'key';
                }
                elseif($count == 2){
                    return 'store';
                }
                break;
        }
    }

    /**
     * Format output to console like
     * @param $output
     * @return array
     */
    public function formatOutput($output){
        $lines = explode("\n",$output);
        $formatted = [];
        foreach ($lines as $line){
            $line .= '<br>';
            $line = str_replace("\t",'<span class="tabbed"></span>',$line);
            $line = str_replace(' ','&nbsp;',$line);
            $line = '<p class="output">' . $line. '</p>';
            array_push($formatted,$line);
        }
        return $formatted;
    }

    /**
     * Call command on artisan and get output
     * @return mixed
     */
    public function callCommand(){
        $options = $this->options;
        $command = $options[0];
        $check = $this->commandBlocked($command);
        if($check)
        {
            $formatted = $this->formatOutput($check['error']);
            $data['command'] = $check['command'];
            $data['lines'] = $formatted;
            return $data;

        }

        Artisan::call($command,collect($options)->slice(1)->all());
        $output = Artisan::output();
        $formatted = $this->formatOutput($output);
        $data['command'] = $command;
        $data['lines'] = $formatted;

        return $data;
    }

    /**
     * Check if command blocked
     * @param $command
     * @return bool
     */
    public function commandBlocked($command){
        $blocked = ['make','tinker'];
        $blocked_config = config('commands.blocked_commands') ?? [];

        $blocked = array_merge($blocked,$blocked_config);
        if(str_contains($command,$blocked)){
            $data['command'] = $command;
            $data['error'] = "Please do not run '$command' via routes!";
            return $data;
        }
        else{
            return false;
        }
    }

}