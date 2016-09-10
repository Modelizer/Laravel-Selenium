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
        'darwin'   => 'mac',
        'winnt'    => 'win',
        'win32'    => 'win',
        'windows'  => 'win',
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
                $this->getWebDriver('chrome'),
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
        $os         = @$this->os[mb_strtolower(PHP_OS)];
        $extension  = $os == 'win' ? 'exe': '';
        $driver     = static::prependPackagePath("drivers/$os-$driverName.$extension");

        if (! is_file($driver)) {
            $this->error(ucfirst($os) . " driver file is not available.");

            exit;
        }

        return "-Dwebdriver.$driverName.driver={$driver}";
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
