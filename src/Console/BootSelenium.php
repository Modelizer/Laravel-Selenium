<?php
namespace Modelizer\Selenium\Console;

use Faker\Provider\UserAgent;
use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $builder = new ProcessBuilder();
        $builder->setTimeout(0);

        // @todo check whether java is installed if not then throw exception.
        $builder->setPrefix('java');

        $command = $builder
            ->setArguments([
                "-jar",
                "{$this->getPackagePath()}selenium.jar",
                "-Dwebdriver.chrome.driver={$this->getWebDriver('chrome')}",
            ])
            ->getProcess()
            ->getCommandLine();

        echo shell_exec($command);
    }

    /**
     * Get web driver full qualified location.
     *
     * @param        $driverName
     * @param string $platform
     * @return string
     */
    protected function getWebDriver($driverName, $platform = '')
    {
        $suffix = empty($platform) ? '' : '-' . $platform;

        return static::getPackagePath() . "drivers/{$driverName}" . $suffix;
    }

    public static function getPackagePath()
    {
        return __DIR__ . "/../../";
    }
}