<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form;

use PPI\Form\Element\ElementInterface;

class Form
{

    protected $elements = array();

    /**
     * The bind data for the form.
     *
     * @var array
     */
    protected $bindData = array();

    function __construct(array $options = array())
    {
    }

    /**
     * Create our form
     *
     * @param string $action
     * @param string $method
     * @param array $options
     * @return string
     */
    public function create($action = '', $method = '', array $options = array())
    {
        return $this->add('form', '', array('method' => $method, 'action' => $action) + $options);
    }

    /**
     * Add a text field to our form
     *
     * @param string $name
     * @param array $options
     * @return object
     */
    public function text($name, array $options = array())
    {
        return $this->add('text', $name, $options);
    }

    /**
     * Add a textarea field to our form
     *
     * @param string $name
     * @param array $options
     * @return object
     */
    public function textarea($name, array $options = array())
    {
        return $this->add('textarea', $name, $options);
    }

    /**
     * Add a password field to our form
     *
     * @param string $name
     * @param array $options
     * @return object
     */
    public function password($name, array $options = array())
    {
        return $this->add('password', $name, $options);
    }

    /**
     * Add a checkbox field to our form
     *
     * @param string $name
     * @param array $options
     * @return object
     */
    public function checkbox($name, array $options = array())
    {
        return $this->add('checkbox', $name, $options);
    }

    /**
     * Add a radio field to our form
     *
     * @param string $name
     * @param array $options
     * @return object
     */
    public function radio($name, array $options = array())
    {
        return $this->add('radio', $name, $options);
    }

    /**
     * Add a submit field
     *
     * @param string $value
     * @param array $options
     * @return object
     */
    public function submit($name, $value = 'Submit', array $options = array())
    {
        return $this->add('submit', '', array('value' => $value) + $options);
    }

    /**
     * Add a hidden field
     *
     * @param string $name
     * @param array $options
     * @return object
     */
    public function hidden($name, array $options = array())
    {
        return $this->add($name, 'hidden', $options);
    }

    /**
     * Add a select (dropdown) field
     *
     * @param string $name
     * @param array $dropdownValues
     * @param array $options
     * @return object
     */
    public function select($name, array $dropdownValues = array(), array $options = array())
    {
        return $this->add('select', array(
                'name' => $name,
                'dropdownValues' => $dropdownValues
            ) + $options);
    }

    /**
     * Add a dropdown field. This is just an alias to $this->select()
     *
     * @param string $name
     * @param array $dropdownValues
     * @param array $options
     * @return object
     */
    public function dropdown($name, array $dropdownValues = array(), array $options = array())
    {
        return $this->select($name, $dropdownValues, $options);
    }

    /**
     * Add a field to our form.
     *
     * @param string $elementType
     * @param array $options
     *
     * @throws \Exception if missing a name option
     *
     * @return object
     */
    public function add($elementType, $name, array $options = array())
    {

        $options['name'] = $name;

        switch ($elementType) {

            case 'form':
            case 'text':
            case 'textarea':
            case 'password':
            case 'submit':
            case 'checkbox':
            case 'radio':
            case 'hidden':
            case 'select':
            case 'dropdown':
                $elementClass = '\PPI\Form\Element\\' . ucfirst($elementType);
                $element = new $elementClass();
                $element->setOptions($options);
                $element->setName($name);
                $element->setType($elementType);
                break;

            default:
                throw new \Exception('Invalid Field Type: ' . $elementType);
        }

        if($elementType === 'dropdown' || $elementType === 'select') {

            // Handle Special Options
            if (isset($options['dropdownValues'])) {
                $values = $options['dropdownValues'];
                unset($options['dropdownValues']);
            }
            if (isset($options['selected'])) {
                $selected = $options['selected'];
                unset($options['selected']);
            }
            $element->setOptions($options);

            // @todo revise this, it needs refactored as we have bind data now.
            if (isset($values)) {
                $element->setValues($values);
            }
            if (isset($selected)) {
                $element->setValue($selected);
            }
        }

        // If we have bind data against the current element. Lets apply it.
        if (!empty($this->bindData) && isset($this->bindData[$name])) {
            $element->setValue($this->bindData[$name]);
        }

        $this->elements[$name] = $element;

        return $element;
    }

    /**
     * Add an element
     *
     * @param ElementInterface $element
     */
    public function addElement(ElementInterface $element)
    {
        $this->elements[$element->getName()] = $element;
    }

    /**
     * Get an element
     *
     * @param string $name
     * @return object
     * @throws \Exception If the element doesn't exist
     */
    public function getElement($name)
    {

        if(!isset($this->elements[$name])) {
            throw new \Exception('Missing element by name: ' . $name);
        }

        return $this->elements[$name];
    }

    /**
     * Get all elements
     *
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Check if an element exists
     *
     * @param string $name
     * @return bool
     */
    public function hasElement($name)
    {
        return isset($this->elements[$name]);
    }

    /**
     * Apply some bind data to this form.
     *
     * @param array $data
     * @return void
     */
    public function bind(array $data)
    {
        $this->bindData = $data;
    }

    public function end()
    {
        return '</form>';
    }

}