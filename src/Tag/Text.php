<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form\Tag;

use PPI\Form\Tag as BaseTag;

class Text extends BaseTag
{

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {
        $this->_attributes = $options;
    }

    /**
     * Set the value of this field
     *
     * @param string $value
     * @return void
     */
    function setValue($value)
    {
        $this->_attributes['value'] = $value;
    }

    /**
     * Get the value of this field.
     *
     * @return string
     */
    function getValue()
    {
        return $this->_attributes['value'];
    }

    /**
     * Render this tag
     *
     * @return string
     */
    function render()
    {
        return '<input type="text" ' . $this->buildAttrs() . '>';
    }
}
