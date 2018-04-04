<?php

namespace Modelizer\Selenium\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Modelizer\Selenium\Traits\WebDriverUtilsTrait;
use Symfony\Component\Process\Process;

class BootSelenium extends Command
{
    use WebDriverUtilsTrait;

    /**
     * DWebDriver name to be use
     * @var array
     */
    protected $dWebDriver = [
        'chrome'  => 'chrome',
        'firefox' => 'gecko',
        'edge'    => 'edge'
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'selenium:start {driver=chrome : (chrome|firefox) Driver version} '.
        '{serverVersion=3.11.0 : Selenium Server Version} ';

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
        $cmd = collect(array_merge($this->getSeleniumDefaultCommand(), $this->getArguments()))
            ->except('driver', 'serverVersion')
            ->implode(' ');

        $this->info('Starting Selenium server v'.$this->argument('serverVersion'));

        echo shell_exec($cmd.' '.$this->getSeleniumOptions());
    }

    /**
     * Get the default commands which are require to boot selenium server
     * @return array
     */
    public function getSeleniumDefaultCommand()
    {
         return [
             'java',
             $this->getWebDriver(env('DEFAULT_BROWSER', $this->argument('driver'))),
             '-jar '.$this->getSeleniumServerQualifiedName()
         ];
    }


    /**
     * Get selenium server qualified location.
     *
     * @throws FileNotFoundException
     *
     * @return string
     */
    public function getSeleniumServerQualifiedName()
    {
        $files = opendir($binDirectory = static::prependPackagePath('vendor/bin'));

        while (false !== ($file = readdir($files))) {
            if (str_contains($file, 'selenium') && str_contains($file, $this->argument('serverVersion'))) {
                return $binDirectory.DIRECTORY_SEPARATOR.$file;
            }
        }

        return $this->downloadSelenium();
    }

    /**
     * Download and get the file name of selenium server.
     *
     * @return string selenium server file directory
     */
    public function downloadSelenium()
    {
        $this->info('Downloading Selenium server file. Please wait...');

        $process = new Process(base_path('vendor/bin/steward install '.$this->argument('serverVersion')));
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
        $config = $this->getConfig();

        if (empty($config)) {
            $this->warn('No web driver loaded.');

            return '';
        }

        $driver = base_path("vendor/bin/{$this->getFileName()}");

        if (!is_file($driver)) {
            $this->call('selenium:web-driver:download', [
                'driver' => $driverName,
            ]);
        }

        return "-Dwebdriver.{$this->dWebDriver[$driverName]}.driver={$driver}";
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
