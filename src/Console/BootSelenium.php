<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Modelizer\Selenium\Traits\HelperTrait;
use Symfony\Component\Process\ProcessBuilder;

class BootSelenium extends Command
{
    use HelperTrait;

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

        $this->downloadWebDriver(env('DEFAULT_BROWSER', 'chrome'));

        $command = $builder
            ->setArguments([
                '-jar',
                static::prependPackagePath('selenium.jar'),
            ])
            ->getProcess()
            ->getCommandLine();

        echo shell_exec($command.' '.$this->getSeleniumOptions());
    }

    /**
     * Download the web driver from the fully qualified location.
     *
     * @param   $driverName
     */
    protected function downloadWebDriver($driverName)
    {
        $config = require __DIR__.'/../../config/drivers.php';

        if (empty($config[$driverName])) {
            return;
        }

        $os = @$this->os[mb_strtolower(PHP_OS)];
        $extension = $os == 'win' ? '.exe' : '';
        $driver = base_path("vendor/bin/{$os}-{$driverName}{$extension}");

        if (!is_file($driver)) {
            $this->call('selenium:download', [
                'driver' => $driverName,
            ]);
        }
    }

    protected function getSeleniumOptions()
    {
        $options = [];

        if (!config('selenium')) {
            return '';
        }

        foreach (config('selenium') as $key => $value) {
            $options[] = "-$key $value";
        }

        return implode(' ', $options);
    }
}
