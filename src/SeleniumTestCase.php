<?php
namespace Modelizer\Selenium;

use PHPUnit_Extensions_Selenium2TestCase;

class SeleniumTestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function visit($path)
    {
        $this->url($path);

        return $this;
    }

    protected function see($text, $tag = 'html')
    {
        $this->assertContains($text, $this->byTag($tag)->text());

        return $this;
    }

    protected function hold($seconds)
    {
        sleep($seconds);

        return $this;
    }

    protected function submitForm($inputs, $selector)
    {
        $form = $this->byCssSelector($selector);

        foreach ($inputs as $input => $value) {
            $form->byName($input)->value($value);
        }

        $form->submit();

        return $this;
    }
}