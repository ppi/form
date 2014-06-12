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

class Select extends BaseTag
{

    const optionsFormat = '<option %svalue="%s">%s</option>';
    const selectFormat = '<select %s>%s</select>';

    /**
     * Dropdown Options
     *
     * @var array
     */
    protected $_options = array();

    /**
     * Selected Dropdown Option
     *
     * @var null
     */
    protected $_selected = null;

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {

        if (isset($options['values'])) {
            $this->setValues($options['values']);
            unset($options['values']);
        }
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        $this->_attributes = $options;
    }


    /**
     * Set the values of this field
     *
     * @param array $options
     * @return void
     */
    function setValues(array $options)
    {
        $this->_options = $options;
    }

    /**
     * Set the selected value
     *
     * @param $value
     * @return void
     */
    function setValue($value)
    {
        $this->_selected = $value;
    }

    /**
     * Build the dropdown options
     *
     * @return void
     */
    function buildOptions()
    {
        $html = '';
        foreach ($this->_options as $key => $val) {
            $selected = '';
            if ($this->_selected !== null && $this->_selected == $val) {
                $selected = 'selected="selected" ';
            }
            $html .= sprintf(self::optionsFormat, $selected, $key, $val);
        }
        return $html;
    }

    /**
     * Render this tag
     *
     * @return string
     */
    function render()
    {
        return sprintf(self::selectFormat, $this->buildAttrs(), $this->buildOptions());
    }

}
