<?php

namespace Modelizer\Selenium\Test;

class FormTest extends TestCase
{


    public function testItCanType()
    {

        $this->visit('/tests/html/main.html')
            ->click('Forms')
            ->see('Forms Test')
            ->type('John', 'firstName')
            ->type('Hoopes', 'lastName')
            ->type('john.hoopes@madisoncreativeweb.com', 'inputEmail');
    }

    public function testItCanTypeInformation()
    {

        $formInfo = [
            'firstName' => 'John',
            'lastName' => 'Hoopes',
            'inputEmail' => 'john.hoopes@madisoncreativeweb.com'
        ];

        $this->visit('/tests/html/main.html')
            ->click('Forms')
            ->see('Forms Test')
            ->typeInformation($formInfo);

    }

    public function testItCanPressAButton()
    {
        $formInfo = [
            'firstName' => 'John',
            'lastName' => 'Hoopes',
            'inputEmail' => 'john.hoopes@madisoncreativeweb.com'
        ];

        $this->visit('/tests/html/main.html')
            ->click('Forms')
            ->see('Forms Test')
            ->typeInformation($formInfo)
            ->press('Submit')
            ->see('Form successfully submitted');
    }

    public function testItCanSubmitForm()
    {

        $formInfo = [
            'firstName' => 'John',
            'lastName' => 'Hoopes',
            'inputEmail' => 'john.hoopes@madisoncreativeweb.com'
        ];

        $this->visit('/tests/html/main.html')
            ->click('Forms')
            ->see('Forms Test')
            ->submitForm($formInfo, '#newAccount')
            ->see('Form successfully submitted');

    }


}