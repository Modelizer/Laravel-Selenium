<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
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
                $this->getWebDriver(env('DEFAULT_BROWSER', 'chrome')),
            ])
            ->getProcess()
            ->getCommandLine();

        echo shell_exec($command . " " . $this->getSeleniumOptions());
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

        if ($this->isExcludedDriver($driverName)) {
            return "-Dwebdriver.$driverName.driver=/Applications/Firefox.app/Contents/MacOS/firefox";
        }

        if (!is_file($driver)) {
            $this->call('selenium:download', [
                'driver' => $driverName,
            ]);
        }

        return "-Dwebdriver.$driverName.driver={$driver}";
    }

    protected function isExcludedDriver($driver)
    {
        return $driver == 'firefox';
    }

    protected function getSeleniumOptions()
    {
        $options = [];

        foreach (config('selenium') as $key => $value) {
            $options[] = "-$key $value";
        }

        return implode(' ', $options);
    }
}
