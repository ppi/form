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

class Textarea extends BaseElement
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
            $this->setValue($value);
        }

        parent::__construct($options);
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
