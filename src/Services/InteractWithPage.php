<?php

namespace Modelizer\Selenium\Services;

use Modelizer\Selenium\Exceptions\CannotClickElement;
use Modelizer\Selenium\Exceptions\CannotFindElement;

trait InteractWithPage
{
    /**
     * Visit a URL within the browser.
     *
     * @param $path
     *
     * @return $this
     */
    protected function visit($path)
    {
        $this->url($path);

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
        $this->execute([
            'script' => 'window.scrollBy(0, '.$amount.')',
            'args'   => [],
        ]);

        return $this;
    }

    /**
     * "Select" a drop-down field.
     *
     * @param $element
     * @param $name
     */
    protected function select($element, $value)
    {
        $this->findElement($element)->value($value);
        
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
        $this->assertContains($text, $this->byTag($tag)->text());

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
        $this->assertNotContains($text, $this->byTag($tag)->text());
    }

    /**
     * User should not be able to see element.
     *
     * @param string $text
     * @param string $tag
     */
    protected function dontSee($text, $tag = 'body')
    {
        $this->assertNotContains($text, $this->byTag($tag)->text());
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
        $this->assertEquals($this->baseUrl.$path, $this->url());

        return $this;
    }

    /**
     * Type a value into a form input by that inputs name.
     *
     * @param $value
     * @param $name
     * @param bool $clear Whether or not to clear the input first on say an edit form
     *
     * @return $this
     */
    protected function type($value, $name, $clear = false)
    {
        $element = $this->findElement($name);

        if ($clear) {
            $element->clear();
        }

        $element->value($value);

        return $this;
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

    protected function submitForm($selector, $inputs)
    {
        $form = $this->byCssSelector($selector);
        $this->typeInformation($inputs);
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
        $this->findElement($text, "//button[contains(., '{$text}')]")->click();

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
        $element = $this->findElement($textOrId, "//a[contains(., '{$textOrId}')]");

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
     * @param $value
     * @param null $xpath
     *
     * @throws CannotFindElement
     *
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    protected function findElement($value, $xpath = null)
    {
        try {
            if (!is_null($xpath)) {
                return $this->byXPath($xpath);
            }
        } catch (\Exception $e) {
        }

        try {
            return $this->byId($value);
        } catch (\Exception $e) {
        }

        try {
            return $this->byName($value);
        } catch (\Exception $e) {
        }

        try {
            return $this->byCssSelector($value);
        } catch (\Exception $e) {
        }


        throw new CannotFindElement('Cannot find element: '.$value.' isn\'t visible on the page');
    }
    
     
}
