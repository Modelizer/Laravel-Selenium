<?php

namespace Modelizer\Selenium\Services;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Modelizer\Selenium\Exceptions\CannotClickElement;
use Modelizer\Selenium\Exceptions\CannotFindElement;

trait InteractWithPage
{
    /**
     * @var RemoteWebDriver
     */
    public $wd;

    /**
     * Visit a URL within the browser.
     *
     * @param $path
     *
     * @return $this
     */
    protected function visit($path = '/')
    {
        $this->wd->get($this->baseUrl.$path);

        return $this;
    }

    /**
     * Scroll the page in the x-axis by the amount specified.
     *
     * @param $amount Positive values go down the page, negative values go up the page
     *
     * @return $this
     */
    protected function scroll($amount)
    {
        $this->wd->executeScript("window.scrollBy(0, {$amount})");

        return $this;
    }

    /**
     * "Select" a drop-down field.
     *
     * @param $value
     * @param $element
     * @return $this
     */
    protected function select($value, $element)
    {
        $this->wd->findElement(WebDriverBy::cssSelector($element))->sendKeys($value);

        return $this;
    }

    /**
     * Assert that we see text within the specified tag
     * Defaults to the body tag.
     *
     * @param $text
     * @param string $tag
     *
     * @return $this
     */
    protected function see($text, $tag = 'body')
    {
        $this->assertContains($text, $this->getTextByTag($tag));

        return $this;
    }

    /**
     * User should not be able to see element.
     *
     * @param $text
     * @param string $tag
     */
    protected function notSee($text, $tag = 'body')
    {
        $this->assertNotContains($text, $this->getTextByTag($tag));
    }

    /**
     * User should not be able to see element.
     *
     * @param string $text
     * @param string $tag
     */
    protected function dontSee($text, $tag = 'body')
    {
        $this->assertNotContains($text, $this->getTextByTag($tag));
    }

    /**
     * Assert the page is at the path that you specified.
     *
     * @param $path
     *
     * @return $this
     */
    protected function seePageIs($path)
    {
        $this->assertEquals($this->wd->getCurrentURL(), $this->baseUrl.$path);

        return $this;
    }

    public function getTextByTag($tag)
    {
         return $this->wd->findElement(WebDriverBy::tagName($tag))->getText();
    }

    /**
     * Type a value into a form input by that input name.
     * Note: Type is an alias of typeBySelectorType
     *
     * @param $value
     * @param $name
     * @param bool $clear Whether or not to clear the input first on say an edit form
     *
     * @return $this
     */
    public function type($value, $name, $clear = false)
    {
        $element = $this->findElement($name);

        if ($clear) {
            $element->clear();
        }

        $element->sendKeys($value);

        return $this;
    }

    /**
     * Abstraction for typing into a field with a specific selector type.
     *
     * @param $type - one of 'Name', 'Id', 'CssSelector'
     * @param $value - value to enter into form element
     * @param $name - value to use for the selector $type
     * @param bool $clear - Whether or not to clear the input first on say an edit form
     *
     * @return $this
     * @throws CannotFindElement
     */
    private function typeBySelectorType($type, $value, $name, $clear = false)
    {
        $element = $this->wd->findElement(WebDriverBy::{$type}($name));

        if ($clear) {
            $element->clear();
        }

        $element->sendKeys($value);

        return $this;
    }

    /**
     * Type a value into a form input by that inputs name.
     *
     * @param $name
     * @param $value
     * @param bool $clear Whether or not to clear the input first on say an edit form
     *
     * @return $this
     */
    protected function typeByName($name, $value, $clear = false)
    {
        return $this->typeBySelectorType('name', $value, $name, $clear);
    }

    /**
     * Type a value into a form input by that inputs id.
     *
     * @param $value
     * @param $name
     * @param bool $clear Whether or not to clear the input first on say an edit form
     *
     * @return $this
     */
    protected function typeById($value, $name, $clear = false)
    {
        return $this->typeBySelectorType('id', $value, $name, $clear);
    }

    /**
     * Type a value into a form input by that inputs id.
     *
     * @param $value
     * @param $name
     * @param bool $clear Whether or not to clear the input first on say an edit form
     *
     * @return $this
     */
    protected function typeByCssSelector($value, $name, $clear = false)
    {
        return $this->typeBySelectorType('cssSelector', $value, $name, $clear);
    }

    /**
     * Function to type information as an array
     * The key of the array specifies the input name.
     *
     * @param $information
     * @param $clear
     *
     * @return $this
     */
    protected function typeInformation($information, $clear = false)
    {
        foreach ($information as $element => $item) {
            $this->type($item, $element, $clear);
        }

        return $this;
    }

    protected function submitForm($inputs, $selector, $clear = false)
    {
        $form = $this->wd->findElement(WebDriverBy::cssSelector($selector));
        $this->typeInformation($inputs, $clear);
        $form->submit();

        return $this;
    }

    /**
     * Press a button on the page that contains text.
     *
     * @param $text
     *
     * @return $this
     */
    protected function press($text)
    {
        $this->wd->findElement(WebDriverBy::xpath("//button[contains(., '{$text}')]"))->click();

        return $this;
    }

    /**
     * Click an element based on text passed in, or pass an Id or Name to find the element by.
     *
     * @param $textOrId
     *
     * @throws CannotClickElement Throws when the element cannot be clicked
     *
     * @return $this
     */
    protected function click($textOrId)
    {
        $element = $this->wd->findElement(WebDriverBy::xpath("//a[contains(., '{$textOrId}')]"));

        try {
            $element->click();
        } catch (\Exception $e) {
            throw new CannotClickElement('Cannot click the element with the text: '.$textOrId);
        }

        return $this;
    }

    /**
     * Will attempt to find an element by different patterns
     * If xpath is provided, will attempt to find by that first.
     *
     * @param null $name
     * @return \Facebook\WebDriver\Remote\RemoteWebElement
     *
     * @throws CannotFindElement
     */
    protected function findElement($name)
    {

        try {
            return $this->wd->findElement(WebDriverBy::id($name));
        } catch (\Exception $e) { }

        try {
            return $this->wd->findElement(WebDriverBy::name($name));
        } catch (\Exception $e) { }

        try {
            return $this->wd->findElement(WebDriverBy::cssSelector($name));
        } catch (\Exception $e) { }

        try {
            return $this->wd->findElement(WebDriverBy::xpath($name));
        } catch (\Exception $e) { }

        throw new CannotFindElement('Cannot find element: '.$value.' isn\'t visible on the page');
    }
}
