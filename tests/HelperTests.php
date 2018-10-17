<?php
namespace kofo\RouteCommands\Tests;

use kofo\RouteCommands\RouteCommandsFacade;

class HelperTests extends TestCase
{
    public function testGenerateOption()
    {
        $pair = RouteCommandsFacade::allOptions('migrate:refresh --force');
//        echo print_r($pair);
        $this->assertArrayHasKey('--force', $pair);
    }

    public function testBlockedCommand(){
        $blocked = RouteCommandsFacade::optionPair('namespace','list');
        echo 'test: '.print_r($blocked);
//        $this->assertArrayHasKey('command',$blocked);
    }

}