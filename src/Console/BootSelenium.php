<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\File;
use Modelizer\Selenium\Traits\HelperTrait;
use Symfony\Component\Process\Process;

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

        return $this->downloadSelenium();
    }

    /**
     * Download and get the file name of selenium server
     *
     * @return string selenium server file directory
     */
    public function downloadSelenium()
    {
        $this->info('Downloading Selenium server file. Please wait...');

        $process = new Process(base_path('vendor/bin/steward install'));
        $process->setTimeout(0);

        $process->run();

        return $process->getOutput();
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
