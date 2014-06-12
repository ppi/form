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

class Form extends BaseTag
{

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {
        $options['action'] = isset($options['action']) ? $options['action'] : '';
        $this->attributes = $options;
    }

    /**
     * Render this tag
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
