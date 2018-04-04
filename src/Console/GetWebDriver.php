<?php

namespace Modelizer\Selenium\Console;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Modelizer\Selenium\Traits\WebDriverUtilsTrait;
use ZipArchive;

class GetWebDriver extends Command
{
    use WebDriverUtilsTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'selenium:web-driver:download {driver : Specify web driver (chrome|firefox)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download web driver for selenium.';

    /**
     * Execute the console command.
     *
     * @param Client $client
     *
     * @return bool
     */
    public function handle(Client $client)
    {
        if (!$resource = $this->checkRequirements()->setConfig()->download($client)) {
            $this->error('Aborting...');

            return false;
        }

        switch ($this->getDriver()) {
            case 'chrome':
                $this->unZip($resource);
                break;
            case 'firefox':
                $this->unTarGz($resource);
                break;
        }

        $this->info('Download complete.');
    }

    /**
     * Check the requirements before downloading.
     *
     * @return $this|bool
     */
    protected function checkRequirements()
    {
        if (!$this->getUserOS()) {
            $this->error("Configuration is not available for $this->userOS operation system.");

            exit;
        }

        return $this;
    }

    /**
     * Downloading driver.
     *
     * @param $client
     *
     * @return bool|string
     */
    protected function download($client)
    {
        $resource = base_path('vendor/bin/driver-file');

        if (is_file(base_path("vendor/bin/{$this->getFileName()}"))) {
            if (!$this->confirm(ucfirst($this->argument('driver')).' web driver file already exists. Would you still like to download it?')) {
                return false;
            }
        }

        $this->info("Downloading {$this->driver} web driver for {$this->userOS}...");

        $resource .= $this->getExtension();

        // Downloading Driver
        $client->request('get', $this->getConfig()['url'], [
            'save_to' => \GuzzleHttp\Psr7\stream_for(fopen($resource, 'w')),
        ]);

        return $resource;
    }

    /**
     * Unzip the web driver raw file.
     *
     * @param $resource
     *
     * @throws \ErrorException
     *
     * @return $this
     */
    public function unZip(&$resource)
    {
        $this->info("Unzipping $resource file...");

        $zip = new ZipArchive();
        if (!$zip->open($resource)) {
            throw new \ErrorException("Unable to unzip downloaded file $resource.");
        }

        // Renaming chrome driver
        $zip->extractTo(dirname($resource));
        $zip->close();

        return $this->cleanUp($resource);
    }

    protected function unTarGz(&$resource)
    {
        // decompress from gz
        (new \PharData($resource))->decompress();

        // Un-archive from the tar
        (new \PharData(dirname($resource).'/driver-file.tar'))->extractTo(dirname($resource));

        return $this->cleanUp($resource);
    }

    protected function cleanUp(&$resource)
    {
        // New file will be saved to vendor/bin directory
        $newFileName = base_path('vendor/bin/'.$this->getFileName());

        // Renaming file
        rename(
            base_path('vendor/bin/'.$this->getConfig()['filename']),
            $newFileName
        );

        // make it executable for unix machine
        $this->userOS == 'win' ?: chmod($newFileName, 0744);

        // Delete the zip file
        unlink($resource);

        return $this;
    }

    public function getExtension()
    {
        switch ($this->getDriver()) {
            case 'chrome':
                return '.zip';
            case 'firefox':
                return '.tar.gz';
        }

        return '';
    }
}
