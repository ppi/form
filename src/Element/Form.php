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

class Form extends BaseElement
{

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {
        $options['action'] = isset($options['action']) ? $options['action'] : '';
        parent::__construct($options);
    }

    /**
     * Render the element
     *
     * @return string
     */
    function render()
    {
        $attrs = $this->buildAttrs();
        return "<form $attrs>";
    }

    /**
     * When echo'ing this tag class, we call render
     *
     * @return string
     */
    function __toString()
    {
        return $this->render();
    }
}
