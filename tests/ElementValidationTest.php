<?php


namespace PPI\Test\Form;


use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ElementValidationTest extends \PHPUnit_Framework_TestCase {

    public function testValidate()
    {
        $validator = Validation::createValidator();

        $element = new \PPI\Form\Element\Password();
        $element->addConstraint(new Assert\NotBlank());
        $element->addConstraint(new Assert\Length(array('min' => 5)));

        $element->setValue('four');
        $validationResult = $element->validate($validator);

        $this->assertFalse($validationResult->isSuccessful());
        $this->assertEquals(1, count($validationResult->getErrorMessages()));

        $element->setValue('');
        $validationResult = $element->validate($validator);

        $this->assertFalse($validationResult->isSuccessful());
        $this->assertEquals(1, count($validationResult->getErrorMessages())); // we are violating 2 constraints,
                                                                              // but NotBlank should take precedence

        $element->setValue('aValidPassword!');
        $validationResult = $element->validate($validator);

        $this->assertTrue($validationResult->isSuccessful());
        $this->assertEquals(0, count($validationResult->getErrorMessages()));
    }
} 