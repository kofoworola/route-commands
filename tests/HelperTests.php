<?php
namespace kofo\RouteCommands\Tests;

use kofo\RouteCommands\RouteCommandsFacade;

class HelperTests extends TestCase
{
    public function testGenerateOption()
    {
        $pair = RouteCommandsFacade::generateAllOptions('migrate:refresh --force');
        echo print_r($pair);
        $this->assertArrayHasKey('--force',$pair);
    }

    public function testGetPath(){
        $path = RouteCommandsFacade::getPathAfterPrefix('commands/migrate_force');
        $this->assertEquals('migrate_force',$path);
    }

}