<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\ProcessBuilder;

class BootSelenium extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'selenium:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Boot Selenium Server.';

    /**
     * Operating System.
     *
     * @var array
     */
    protected $os = [
        'Darwin' => 'mac',
    ];

    /**
     * Execute the console command.
     *
     * @param ProcessBuilder $builder
     */
    public function handle(ProcessBuilder $builder)
    {
        $builder->setTimeout(0);

        // @todo check whether java is installed if not then throw exception.
        $builder->setPrefix('java');

        $command = $builder
            ->setArguments([
                '-jar',
                static::prependPackagePath('selenium.jar'),
                "-Dwebdriver.chrome.driver={$this->getWebDriver('chrome')}",
            ])
            ->getProcess()
            ->getCommandLine();

        echo shell_exec($command);
    }

    /**
     * Get web driver full qualified location.
     *
     * @param   $driverName
     *
     * @return string
     */
    protected function getWebDriver($driverName)
    {
        $driver = static::prependPackagePath('drivers/'.$this->os[PHP_OS]."-$driverName");

        if (!is_file($driver)) {
            $this->error(ucfirst($this->os[PHP_OS]).' driver file is not available.');

            exit;
        }

        return $driver;
    }

    /**
     * Get the real path with package path prepended.
     *
     * @param $suffix
     *
     * @return string
     */
    public static function prependPackagePath($suffix)
    {
        return realpath(__DIR__."/../../$suffix");
    }
}
