<?php

namespace Modelizer\Selenium\Services;

trait ManageWindow
{
    /**
     * Change the current window's width and height.
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function changeWindowSize($width = 1024, $height = 768)
    {
        if (!empty($width) && !empty($height) &&
            is_int(intval($width)) && is_int(intval($height))) {
            $this->prepareSession()->currentWindow()->size([
                'width'  => intval($width),
                'height' => intval($height),
            ]);
        }

        return $this;
    }

    /**
     * Set the current window's width.
     *
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this->changeWindowSize($this->width, $this->height);
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
        $this->height = $height;

        return $this->changeWindowSize($this->width, $this->height);
    }
}
