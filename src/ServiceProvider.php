<?php

namespace kofo\RouteCommands;

use function foo\func;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use PhpParser\Node\Scalar\MagicConst\Dir;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config_path = __DIR__."/config/commands.php";
        $this->publishes([$config_path => config_path('commands.php')]);

        $route_config =[
            'prefix' => $this->app['config']->get('commands.route_prefix'),
            'namespace' => 'kofo\RouteCommands\Controllers',
            'middleware' => ['web']
        ];
        $routes = $this->app['config']->get('commands.routes') ?? [];

        $this->app['router']->group($route_config,function ($router) use (&$routes){
            foreach ($routes as $route => $command){
                $router->get($route,'RouteCommandsController@handle');
                $router->post($route,'RouteCommandsController@authenticate');
            }
        });

        $this->loadViewsFrom(__DIR__."/../views",'route-commands');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $config_path = __DIR__."/config/commands.php";
        $this->mergeConfigFrom($config_path,'commands');

        $this->app->singleton(RouteCommands::class,function(){
           return new RouteCommands();
        });

        $this->app->alias(RouteCommands::class,'route-commands');
    }
}
