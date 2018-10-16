<?php
if(! function_exists('get_path_after_prefix')){
    /**
     * Gets the path after removing the prefix
     * @return string
     */
    function get_path_after_prefix($path = ''){
        if(is_null($path) || $path == ''){
            $path = \Illuminate\Support\Facades\Request::path();
        }
        return str_after($path,config('commands.route_prefix').'/');
    }
}

if(! function_exists('generate_option_pair')){
    /**
     * Generate option pair from the passed word
     * @param $option
     * @return array
     */
    function generate_option_pair($option){
        $pair = [];
        if(str_contains($option,['-','--'])){
            if(str_contains($option,'=')){
                $split = explode('=',$option);
                $pair[$split[0]] = $split[1];
            }
            else{
                $pair[$option] = true;
            }
        }
        else{
//            $key = $this->guessKey($this->command);
//            $fixed[$key] = $$option;
            echo 'will have to guess key';
        }
        return $pair;
    }
}

if(!function_exists('generate_all_options')){
    /**
     * Generates all option pairs from the command string
     * @param $string
     * @return array
     */
    function generate_all_options($string){
        $words = explode(' ',$string);
        $options = [];
        array_push($options,$words[0]);
        if(count($words) > 1)
        {
            for($i=1;$i<count($words);$i++){
                $pair = generate_option_pair($words[$i]);
                array_push($options,$pair);
            }

        }
        return $options;
    }
}