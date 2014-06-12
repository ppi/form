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

class Select extends BaseElement
{

    const optionsFormat = '<option %svalue="%s">%s</option>';
    const selectFormat = '<select %s>%s</select>';

    /**
     * Dropdown Options
     *
     * @var array
     */
    protected $options = array();

    /**
     * Selected Dropdown Option
     *
     * @var null
     */
    protected $selected = null;

    /**
     * The constructor
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        if (isset($options['values'])) {
            $this->setValues($options['values']);
            unset($options['values']);
        }

        parent::setOptions($options);
    }


    /**
     * Set the values of this field
     *
     * @param array $options
     * @return void
     */
    function setValues(array $options)
    {
        $this->options = $options;
    }

    /**
     * Set the selected value
     *
     * @param $value
     * @return void
     */
    function setValue($value)
    {
        $this->selected = $value;
    }

    /**
     * Build the dropdown options
     *
     * @return void
     */
    function buildOptions()
    {
        $html = '';
        foreach ($this->options as $key => $val) {
            $selected = '';
            if ($this->selected !== null && $this->selected == $val) {
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
