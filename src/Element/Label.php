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

class Label extends BaseElement
{

    /**
     * Render the element
     *
     * @return string
     */
    function render()
    {

        // Auto-set the 'for' attribute of this to match the ID of the 'name'

        $html = '<label %s>%s</label>';
        $result = sprintf($html, $this->buildAttrs(), $this->getValue());
        return $result;
    }
}
