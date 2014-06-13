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

    protected $type = 'textarea';

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
     * Render the element
     *
     * @return string
     */
    function render()
    {
        return '<textarea ' . $this->buildAttrs() . '>' . $this->getValue() . '</textarea>';
    }
}
