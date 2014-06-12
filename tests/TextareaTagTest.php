<?php
namespace PPI\Test\Form;

use PPI\Form\Element\Textarea;

class TextareaElementTest extends \PHPUnit_Framework_TestCase
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
        $output = $this->form->textarea('desc')->render();
        $this->assertEquals($output, '<textarea name="desc"></textarea>');
    }

    function testCreateWithAttrs()
    {
        $output = $this->form->textarea('desc', array('id' => 'bar'))->render();
        $this->assertEquals($output, '<textarea name="desc" id="bar"></textarea>');
    }

    function testDirectClass()
    {
        $text = new Textarea(array(
            'value' => 'my description',
            'name' => 'desc',
            'id' => 'bar'
        ));
        $output = $text->render();
        $this->assertEquals($output, '<textarea name="desc" id="bar">my description</textarea>');
    }

    function testDirectClass__toString()
    {
        $text = new Textarea(array(
            'value' => 'my description',
            'name' => 'desc',
            'id' => 'bar'
        ));
        $output = (string)$text;
        $this->assertEquals($output, '<textarea name="desc" id="bar">my description</textarea>');
    }

    function testHasAttr()
    {
        $text = new Textarea(array(
            'value' => 'my description',
            'name' => 'desc',
            'id' => 'bar'
        ));
        $this->assertTrue($text->hasAttr('name'));
        $this->assertFalse($text->hasAttr('nonexistantattr'));
    }

    function testGetAttr()
    {
        $text = new Textarea(array(
            'value' => 'my description',
            'name' => 'desc',
            'id' => 'bar'
        ));
        $this->assertEquals('desc', $text->attr('name'));
    }

    function testSetAttr()
    {
        $text = new Textarea(array(
            'value' => 'my description'
        ));
        $text->attr('foo', 'bar');
        $this->assertEquals('bar', $text->attr('foo'));
    }

    function testGetValues()
    {
        $text = new Textarea(array(
            'value' => 'textvalue'
        ));
        $this->assertEquals('textvalue', $text->getValue());
    }

    function testSetValue()
    {
        $text = new Textarea();
        $text->setValue('my description');
        $this->assertEquals('my description', $text->getValue());
    }
}