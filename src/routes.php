<?php

$prefix = config('commands.route_prefix') ?? config('route-commands:commands.route_prefix');
Route::get(config('kofo/route-commands:commands.route_prefix'),function (){
   return 'Hello world';
});