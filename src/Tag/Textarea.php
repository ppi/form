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

class Textarea extends BaseTag
{

    /**
     * The textarea value
     *
     * @var string
     */
    protected $value = '';

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {

        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
            $this->value = $value;
        }
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
        $this->value = $value;
    }

    /**
     * Get the value of this field.
     *
     * @return string
     */
    function getValue()
    {
        return $this->value;
    }

    /**
     * Render this tag
     *
     * @return string
     */
    function render()
    {
        return '<textarea ' . $this->buildAttrs() . '>' . $this->getValue() . '</textarea>';
    }
}
