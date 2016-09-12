<?php

namespace Modelizer\Selenium\Services;

use Modelizer\Selenium\Exceptions\CannotFindElement;

trait WaitForElement
{
    protected $waitForTypes = ['Id', 'CssSelector', 'ClassName', 'XPath'];

    /**
     * Generalized WaitsFor function to wait for a specific element with value
     * by the type passed.
     *
     * @param $type The type of selector we are using to wait for
     * @param $value The value of the selector we are using
     * @param $timeout
     *
     * @throws \Exception
     */
    protected function waitForElement($type, $value, $timeout)
    {
        if (!in_array($type, $this->waitForTypes)) {
            throw new \Exception('Invalid wait for element type to wait for on the page');
        }

        $webdriver = $this;
        $this->waitUntil(function () use ($type, $value, $webdriver) {
            $function = 'by'.$type;

            try {
                $webdriver->$function($value);

                return true;
            } catch (\Exception $e) {
                return; // haven't found the element yet
            }
        }, $timeout);
    }

    /**
     * Helper method to wait for an element with the specified class.
     *
     * @param $class
     * @param int $timeout
     *
     * @throws CannotFindElement
     *
     * @return $this
     */
    protected function waitForElementsWithClass($class, $timeout = 2000)
    {
        try {
            $this->waitForElement('ClassName', $class, $timeout);
        } catch (\Exception $e) {
            throw new CannotFindElement("Can't find an element with the class name of "
                .$class.' within the time period of '.$timeout.' miliseconds');
        }

        return $this;
    }

    /**
     * Helper method to wait for an element with the specified id.
     *
     * @param $id
     * @param int $timeout
     *
     * @throws CannotFindElement
     *
     * @return $this
     */
    protected function waitForElementWithId($id, $timeout = 2000)
    {
        try {
            $this->waitForElement('Id', $id, $timeout);
        } catch (\Exception $e) {
            throw new CannotFindElement("Can't find an element with an ID of "
                .$id.' within the time period of '.$timeout.' miliseconds');
        }

        return $this;
    }

    /**
     * Helper method to wait for an element with the specified xpath.
     *
     * @param $xpath
     * @param int $timeout
     *
     * @throws CannotFindElement
     *
     * @return $this
     */
    protected function waitForElementWithXPath($xpath, $timeout = 2000)
    {
        try {
            $this->waitForElement('XPath', $xpath, $timeout);
        } catch (\Exception $e) {
            throw new CannotFindElement("Can't find an element with an XPath of "
                .$xpath.' within the time period of '.$timeout.' miliseconds');
        }

        return $this;
    }
}
