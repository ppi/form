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

    protected $type = 'radio';

    /**
     * Render the element
     *
     * @return string
     */
    function render()
    {
        return '<input type="radio" ' . $this->buildAttrs() . '>';
    }
}
