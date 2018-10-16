<?php
namespace kofo\RouteCommands\Tests;

class HelperTests extends TestCase
{
    public function testGenerateOption()
    {
        $pair = generate_option_pair('--force=yes');
//        echo print_r($pair);
        $this->assertArrayHasKey('--force',$pair);
    }
//
//    public function testGenerateAllOptions(){
//        $options = generate_all_options('migrate:rollback --step=1');
////        echo "\n all options: \n ".print_r($options);
//    }

    public function testGetPath(){
        $path = get_path_after_prefix('commands/migrate_force');
        $this->assertEquals('wow',$path);
    }

    public function testAll(){

    }

}