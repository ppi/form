<?php
namespace PPI\Test\Form;

use PPI\Form\Rule\Required;

class RequiredRuleTest extends \PHPUnit_Framework_TestCase
{

    protected $rule;

    function setUp()
    {
        $this->rule = new Required();
    }

    function tearDown()
    {
        unset($this->rule);
    }

    /**
     * @dataProvider providerForValidationTrue
     */
    function testValidatesTrue($data)
    {
        $this->assertTrue($this->rule->validate($data));
    }

    /**
     * @dataProvider providerForValidationFalse
     */
    function testValidatesFalse($data)
    {
        $this->assertFalse($this->rule->validate($data));
    }

    function providerForValidationTrue()
    {
        return array(
            array('foo'),
            array(1),
            array(0), //zero could be a valid form value
        );
    }

    function providerForValidationFalse()
    {
        return array(
            array(''),
            array(' '), //whitespace is not valid
        );
    }
}