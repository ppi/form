<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form\Element;

use PPI\Form\Element\Element as BaseElement;

class Radio extends BaseElement
{

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {
        $this->attributes = $options;
    }

    /**
     * Set the value of this field
     *
     * @param string $value
     * @return void
     */
    function setValue($value)
    {
        $this->attributes['value'] = $value;
    }

    /**
     * Get the value of this field.
     *
     * @return string
     */
    function getValue()
    {
        return $this->attributes['value'];
    }

    /**
     * Render this tag
     *
     * @return string
     */
    function render()
    {
        return '<input type="radio" ' . $this->buildAttrs() . '>';
    }
}
