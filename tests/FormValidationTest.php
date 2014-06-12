<?php


namespace PPI\Test\Form;

use Symfony\Component\Validator\Constraints as Assert;

use PPI\Form\Element\Password;
use PPI\Form\Element\Text;
use PPI\Form\Form;

class FormValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testFormValidation()
    {
        $form = new Form();

        $element1 = new Password();
        $element1->setName('password_el');
        $element1->setValue('');
        $element1->addConstraint(new Assert\NotBlank());

        $element2 = new Text();
        $element2->setName('text_el');
        $element2->setValue('not12chars');
        $element2->addConstraint(new Assert\Length(array('min' => 12)));

        $element3 = new Text();
        $element3->setName('email_el');
        $element3->setValue('something@something.com');
        $element3->addConstraint(new Assert\Email());

        $form->addElement($element1);
        $form->addElement($element2);
        $form->addElement($element3);

        $errorMessages = $form->validate();

        $this->assertEquals(2, count($errorMessages));
        $this->assertArrayHasKey($element1->getName(), $errorMessages);
        $this->assertArrayHasKey($element2->getName(), $errorMessages);
        $this->assertArrayNotHasKey($element3->getName(), $errorMessages);
    }
} 