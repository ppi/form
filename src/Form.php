<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form;

use PPI\Form\Element\Element;
use PPI\Form\Element\ElementInterface;

class Form
{

    protected $elements = array();

    protected $elementTypes = array(
        'text', 'textarea', 'password', 'submit',
        'checkbox', 'radio', 'hidden', 'select', 'dropdown'
    );

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

    public function label($label, $name = null, array $options = array())
    {
        throw new \Exception('To be implemented');
        $name = 'label_for_' . $name;
        return $this->add('label', $name, array('value' => $label) + $options);
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
     * @param string $name
     * @param array $options
     *
     * @throws \Exception if missing a name option
     *
     * @return object
     */
    public function add($elementType, $name, array $options = array())
    {

        if (empty($elementType)) {
            throw new \Exception('Missing element type');
        }

        if (empty($name)) {
            throw new \Exception('Missing name option');
        }

        // Create the element
        $element = $this->createElement($elementType, $name, $options);
        $element->attr('name', $name);


        switch ($elementType) {
            case 'dropdown':
            case 'select':

                // Handle Special Options
                if (isset($options['dropdownValues'])) {
                    $values = $options['dropdownValues'];
                    unset($options['dropdownValues']);
                }
                if (isset($options['selected'])) {
                    $selected = $options['selected'];
                    unset($options['selected']);
                }
                // Re-apply options after some manipulation
                $element->setOptions($options);

                // @todo revise this, it needs refactored as we have bind data now.
                if (isset($values)) {
                    $element->setValues($values);
                }
                if (isset($selected)) {
                    $element->setValue($selected);
                }
                break;

            case 'label':

                // @todo - keep a list of "labels to process" so if you add an element at a later date,
                // it will find previously added labels and populate them
                // Setup the for="" for this label to pull from the element's ID matching $name
                if (isset($this->elements[$name]) && $this->elements[$name]->hasAttribute('id')) {
                    $element->setAttribute('for', $this->elements[$name]->getAttribute('id'));
                }

        }

        $this->addElement($element);

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

        if (!isset($this->elements[$name])) {
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
        if (empty($this->elements)) {
            return;
        }

        // Bind data to existing elements
        foreach ($data as $key => $val) {
            if (isset($this->elements[$key])) {
                $this->elements[$key]->setValue($val);
            }
        }
    }

    /**
     * Create an element
     *
     * @param string $type
     * @param string $name
     * @param array $options
     *
     * @throws \Exception if an invalid field type is passed
     *
     * @return Element
     */
    protected function createElement($type, $name, array $options = array())
    {
        if (!in_array($type, $this->elementTypes)) {
            throw new \Exception('Invalid Field Type: ' . $type);
        }

        $elementClass = '\PPI\Form\Element\\' . ucfirst($type);
        /**
         * @var Element $element
         */
        $element = new $elementClass();
        $element->setOptions($options);
        $element->setAttributes($options);
        $element->setName($name);
        $element->setType($type);

        // Data Binding to this element if we have data for it.
        if (!empty($this->bindData) && isset($this->bindData[$name])) {
            $element->setValue($this->bindData[$name]);
        }

        return $element;
    }

    public function end()
    {
        return '</form>';
    }

}