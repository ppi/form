<?php
namespace PPI\Test\Form;

use PPI\Form\Rule\Maxlength;

class MaxlengthRuleTest extends \PHPUnit_Framework_TestCase
{

    protected $rule;

    function setUp()
    {
        $this->rule = new Maxlength();
    }

    function tearDown()
    {
        unset($this->rule);
    }

    /**
     * @dataProvider providerForValidationTrue
     */
    function testValidatesTrue($size, $data)
    {
        $this->rule->setRuleData($size);
        $this->assertTrue($this->rule->validate($data));
    }

    /**
     * @dataProvider providerForValidationFalse
     */
    function testValidatesFalse($size, $data)
    {
        $this->rule->setRuleData($size);
        $this->assertFalse($this->rule->validate($data));
    }

    function providerForValidationTrue()
    {
        return array(
            array(10, '0123456789'),
            array(10, '   0123456789   '), //whitespace is ignored
            array(10, '0'),
            array(10, ''),
        );
    }

    function providerForValidationFalse()
    {
        return array(
            array(10, '0123456789012'),
            array(10, '  0123456789012  '),
        );
    }
}
