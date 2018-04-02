<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\File;
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
            $this->getWebDriver(env('DEFAULT_BROWSER', 'chrome')),
            '-jar',
            $this->getSeleniumServerQualifiedName(),
        ], ' ');

        echo shell_exec($cmd.' '.$this->getSeleniumOptions());
    }

    /**
     * Get selenium server qualified location
     *
     * @return string
     *
     * @throws FileNotFoundException
     */
    public function getSeleniumServerQualifiedName()
    {
        $files = opendir($binDirectory = static::prependPackagePath('vendor/bin'));

        while (false !== ($file = readdir($files))) {
            if (str_contains($file, 'selenium')) {
                return $binDirectory . DIRECTORY_SEPARATOR . $file;
            }
        }

        throw new FileNotFoundException(
            'Selenium server jar file not found in ' . $binDirectory .
            ' directory. Please put the file manually or run ' .
            '"vendor/bin/steward install" command'
        );
    }


    /**
     * Get web driver full qualified location.
     *
     * @param $driverName
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
            $this->call('selenium:web-driver:download', [
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
