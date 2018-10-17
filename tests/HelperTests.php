<?php
namespace kofo\RouteCommands\Tests;

use kofo\RouteCommands\RouteCommandsFacade;

class HelperTests extends TestCase
{
    public function testGenerateOption()
    {
        $pair = RouteCommandsFacade::allOptions('migrate:refresh --force');
        $this->assertArrayHasKey('--force', $pair);
    }

    public function testBlockedCommand(){
        $blocked = RouteCommandsFacade::guessKey('app.name','cache:forge',1);
        echo print_r($blocked);
//        $this->assertArrayHasKey('command',$blocked);
    }

}