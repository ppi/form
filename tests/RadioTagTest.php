<?php
namespace PPI\Test\Form;

use PPI\Form\Element\Radio;

class RadioboxElementTest extends \PHPUnit_Framework_TestCase
{

    protected $form;

    function setUp()
    {
        $this->form = new \PPI\Form\Form();
    }

    function tearDown()
    {
        unset($this->form);
    }

    function testCreate()
    {
        $output = $this->form->radio('myradio')->render();
        $this->assertEquals($output, '<input type="radio" name="myradio">');
    }

    function testCreateWithAttrs()
    {
        $output = $this->form->radio('myradio', array('id' => 'bar'))->render();
        $this->assertEquals($output, '<input type="radio" name="myradio" id="bar">');
    }

    function testDirectClass()
    {
        $radio = new Radio(array(
            'value' => 'foo_radio',
            'name' => 'myradio',
            'id' => 'bar'
        ));
        $output = $radio->render();
        $this->assertEquals($output, '<input type="radio" value="foo_radio" name="myradio" id="bar">');
    }

    function testDirectClass__toString()
    {
        $radio = new Radio(array(
            'value' => 'foo_radio',
            'name' => 'myradio',
            'id' => 'bar'
        ));
        $output = (string)$radio;
        $this->assertEquals($output, '<input type="radio" value="foo_radio" name="myradio" id="bar">');
    }

    function testHasAttr()
    {
        $radio = new Radio(array(
            'value' => 'foo_radio',
            'name' => 'myradio',
            'id' => 'bar'
        ));
        $this->assertTrue($radio->hasAttr('name'));
        $this->assertFalse($radio->hasAttr('nonexistantattr'));
    }

    function testGetAttr()
    {
        $radio = new Radio(array(
            'value' => 'foo_radio',
            'name' => 'myradio',
            'id' => 'bar'
        ));
        $this->assertEquals('foo_radio', $radio->attr('value'));
    }

    function testSetAttr()
    {
        $radio = new Radio(array(
            'value' => 'foo_radio'
        ));
        $radio->attr('foo', 'bar');
        $this->assertEquals('bar', $radio->attr('foo'));
    }

    function testGetValues()
    {
        $radio = new Radio(array(
            'value' => 'foo_radio'
        ));
        $this->assertEquals('foo_radio', $radio->getValue());
        $this->assertEquals('foo_radio', $radio->attr('value'));
    }

    function testSetValue()
    {
        $radio = new Radio();
        $radio->setValue('foo_radio');
        $this->assertEquals('foo_radio', $radio->getValue());
    }
}