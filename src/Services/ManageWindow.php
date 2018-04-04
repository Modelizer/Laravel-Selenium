<?php

namespace Modelizer\Selenium\Services;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverPoint;

trait ManageWindow
{
    /**
     * @var RemoteWebDriver
     */
    public $wd;

    /**
     * Change the current window's width and height.
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function changeWindowSize(int $width = 1024, int $height = 768)
    {
        $this->wd->manage()->window()->setPosition(new WebDriverPoint($width, $height));

        return $this;
    }

    /**
     * Set the current window's width.
     *
     * @param $width
     *
     * @return \Facebook\WebDriver\WebDriverWindow
     */
    public function setWidth($width)
    {
        return $this->wd->manage()
            ->window()
            ->setPosition(new WebDriverPoint($width, self::BROWSER_HEIGHT));
    }

    /**
     * Set the current window's height.
     *
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        return $this->changeWindowSize(self::BROWSER_WIDTH, $height);
    }
}
