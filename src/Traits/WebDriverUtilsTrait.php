<?php

namespace Modelizer\Selenium\Traits;

trait WebDriverUtilsTrait
{
    /**
     * List of operating system.
     *
     * @var array
     */
    protected $os = [
        'darwin'  => 'mac',
        'winnt'   => 'win',
        'win32'   => 'win',
        'windows' => 'win',
        'linux'   => 'linux',
    ];

    /**
     * Web driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * User current operating system.
     *
     * @var string
     */
    protected $userOS;

    /**
     * Resource file of web driver (raw zip file).
     *
     * @var string
     */
    protected $resource;

    /**
     * Configuration of web drivers.
     *
     * @var array
     */
    protected $config;

    /**
     * @param string|null $key
     * @return string
     */
    abstract function argument($key = null);

    /**
     * Get driver.
     *
     * @return string
     */
    protected function getDriver()
    {
        return $this->driver ?: $this->driver = $this->argument('driver');
    }

    /**
     * Get user operating system.
     *
     * @return mixed
     */
    public function getUserOS()
    {
        return $this->userOS ?: $this->userOS = @$this->os[mb_strtolower(PHP_OS)];
    }

    /**
     * Loading drivers specific download path and version.
     *
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config ?: $this->setConfig()->getConfig();
    }

    /**
     * Set the configuration for web drivers.
     *
     * @throws \ErrorException
     *
     * @return $this
     */
    public function setConfig()
    {
        $this->config = (require static::prependPackagePath('bootstrap/config.php'))['web-drivers'];

        $this->config = @$this->config[$this->getDriver()][$this->getUserOS()];

        if (!$this->config) {
            throw new \ErrorException("Currently {$this->getDriver()} not supported.");
        }

        return $this;
    }

    /**
     * Get web driver file name with extension
     *
     * @return string
     */
    public function getFileName()
    {
        return "{$this->getUserOS()}-{$this->getDriver()}{$this->getFileExtension()}";
    }

    /**
     * Get web driver file extension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->getUserOS() == 'win' ? '.exe' : '';
    }

    /**
     * Get the real path with package path prepended.
     *
     * @param string $suffix suffix the file needed
     * @param bool   $assume Possible directory can be created.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public static function prependPackagePath($suffix, $assume = false)
    {
        $path = __DIR__."/../../$suffix";

        if (!$assume and !$path) {
            throw new \Exception("$path path does not exists.");
        }

        return $assume ? $path : realpath($path);
    }
}
