<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form\Element;

interface ElementInterface
{

    /**
     * Getter and setter for attributes
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    function attr($name, $value = '');

    /**
     * Render the tag
     *
     * @return void
     */
    function render();

}