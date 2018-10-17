<?php
/**
 * Created by PhpStorm.
 * User: kofo
 * Date: 10/16/18
 * Time: 5:54 PM
 */

namespace kofo\RouteCommands\Tests;


use kofo\RouteCommands\RouteCommands;
use kofo\RouteCommands\ServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return ServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'RouteCommands' => RouteCommands::class
        ];
    }
}