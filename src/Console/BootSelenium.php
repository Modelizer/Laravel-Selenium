<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Modelizer\Selenium\Traits\HelperTrait;

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
     */
    public function handle()
    {
        $cmd = implode([
            'java',
            '-jar',
            static::prependPackagePath('selenium.jar'),
            $this->getWebDriver(env('DEFAULT_BROWSER', 'chrome')),
        ], ' ');

        echo shell_exec($cmd.' '.$this->getSeleniumOptions());
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
        $config = require __DIR__.'/../../config/drivers.php';

        if (empty($config[$driverName])) {
            return '';
        }

        $os = @$this->os[mb_strtolower(PHP_OS)];
        $extension = $os == 'win' ? '.exe' : '';
        $driver = base_path("vendor/bin/{$os}-{$driverName}{$extension}");

        if (!is_file($driver)) {
            $this->call('selenium:download', [
                'driver' => $driverName,
            ]);
        }

        return "-Dwebdriver.$driverName.driver={$driver}";
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
