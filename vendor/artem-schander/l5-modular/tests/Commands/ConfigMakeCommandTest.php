<?php

namespace ArtemSchander\L5Modular\Tests\Commands;

use ArtemSchander\L5Modular\Tests\MakeCommandTestCase;

class ConfigMakeCommandTest extends MakeCommandTestCase
{
    private $command = 'make:module:config';

    /** @test */
    public function should_not_generate_when_module_dont_exists()
    {
        $this->artisan($this->command, [ '--module' => $this->moduleName ])->assertExitCode(false);
    }

    /** @test */
    public function should_generate_when_module_exists()
    {
        $this->artisan('make:module', ['name' => $this->moduleName])
            ->assertExitCode(0);

        $this->artisan($this->command, [ '--module' => $this->moduleName ])->assertExitCode(0);

        $this->assertFileExists($this->modulePath . '/config.php');
    }

    /** @test */
    public function should_ask_for_module_when_no_module_given()
    {
        $this->artisan('make:module', ['name' => $this->moduleName])
            ->assertExitCode(0);

        $this->artisan($this->command)
            ->expectsQuestion('In what module would you like to generate?', $this->moduleName)
            ->assertExitCode(0);

        $this->assertFileExists($this->modulePath . '/config.php');
    }
}
