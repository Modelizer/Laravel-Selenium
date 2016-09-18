<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modelizer\Selenium\Traits\Helper;
use Symfony\Component\Process\ProcessBuilder;

class BootSelenium extends Command
{
    use Helper;

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
        $os = @$this->os[mb_strtolower(PHP_OS)];
        $extension = $os == 'win' ? '.exe' : '';
        $driver = base_path("vendor/bin/{$os}-{$driverName}{$extension}");

        if (!is_file($driver)) {
            $this->call('selenium:download');
        }

        return "-Dwebdriver.$driverName.driver={$driver}";
    }
}
