<?php

namespace Modelizer\Selenium\Services;

trait InteractsWithPage
{

    /**
     * Visit a URL within the browser
     *
     * @param $path
     * @return $this
     */
    protected function visit($path)
    {
        $this->url($path);

        return $this;
    }

    protected function scroll($amount)
    {

        $this->execute([
            'script' => 'window.scrollBy(0, ' . $amount . ')',
            'args'   => []
        ]);
        return $this;
    }

    /**
     * Assert that we see text within the specified tag
     * Defaults to the body tag
     *
     * @param $text
     * @param string $tag
     * @return $this
     */
    protected function see($text, $tag = 'body')
    {
        $this->assertContains($text, $this->byTag($tag)->text());
        return $this;
    }

    /**
     * Assert the page is at the path that you specified
     *
     * @param $path
     * @return $this
     */
    protected function seePageIs($path)
    {
        $this->assertEquals($this->baseUrl . $path, $this->url());
        return $this;
    }

    /**
     * Type a value into a form input by that inputs name
     *
     * @param $value
     * @param $name
     * @return $this
     */
    protected function type($value, $name)
    {
        $this->findElement($name)->value($value);

        return $this;
    }

    /**
     * Press a button on the page that contains text
     *
     * @param $text
     * @return $this
     */
    protected function press($text)
    {
        $this->byXPath("//button[contains(text(), '{$text}')]")->click();
        return $this;
    }

    /**
     * Click an element based on text passed in, or pass an Id or Name to find the element by
     *
     * @param $textOrId
     * @return $this
     * @throws CannotClickElement Throws when the element cannot be clicked
     */
    protected function click($textOrId)
    {
        try {
            $element = $this->findElement($textOrId, "//a[contains(text(), '{$textOrId}')]");
        }catch(\Exception $e ) {}

        try {
            $element->click();
        }catch (\Exception $e) {
            throw new CannotClickElement('Cannot click the element with the text: ' . $textOrId);
        }

        return $this;
    }

    /**
     * Will attempt to find an element by different patterns
     * If xpath is provided, will attempt to find by that first
     *
     * @param $value
     * @param null $xpath
     * @return \PHPUnit_Extensions_Selenium2TestCase_Element
     * @throws CannotFindElement
     */
    protected function findElement($value, $xpath = null)
    {
        $element = null;
        try {
            if(!is_null($xpath)) {
                $element = $this->byXPath($xpath);
            }
        }catch(\Exception $e) {}

        try {
            $element = $this->byId($value);
        }catch(\Exception $e) {}

        try {
            $element = $this->byName($value);
        }catch(\Exception $e) {}

        try {
            $element = $this->byCssSelector($value);
        }catch(\Exception $e) {}

        if(!is_null($element)) {
            return $element;
        }else {
            throw new CannotFindElement('Cannot find element: ' . $value . ' isn\'t visible on the page');
        }

    }

}