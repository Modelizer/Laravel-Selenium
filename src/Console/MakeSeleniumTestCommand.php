<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Modelizer\Selenium\Traits\WebDriverUtilsTrait;

class MakeSeleniumTestCommand extends GeneratorCommand
{
    use WebDriverUtilsTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'selenium:make:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new selenium test class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'SeleniumTest';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return self::prependPackagePath('stubs/test.stub');
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);

        return $this->laravel['path.base'].'/tests/'.str_replace('\\', '/', $name).'.php';
    }
}
