<?php


namespace PPI\Form\Element;

/**
 * An abstract Element which encapsulates the rendering of several inputs and transforms the independent data into something
 * suitable for validation.
 *
 * Class Virtual
 * @package PPI\Form\Element
 */
abstract class Virtual extends Element
{
    protected $elements = array();

    public function addElement(Element $element)
    {
        $this->elements[] = $element;
    }

    public function __construct($options = array())
    {
        parent::__construct($options);
    }

    /**
     * Render the tag
     *
     * @return string
     */
    public function render()
    {
        $parts = array();

        foreach($this->elements as $element) {
            $parts[] = $element->render();
        }

        return implode("\n", $parts);
    }

    /**
     * Takes an array of input and returns a string. Should be used when you have 2 elements which should be concatenated into 1 variable.
     *
     * For example, if you want a TimeElement which allows the user to choose hours via a select element, and minutes via a select element
     * then you should get the input as an array (input_x[0] -- hours, input_x[1] -- minutes) and implement this method
     * to join both of those inputs.
     *
     * @param array $data
     * @return string
     */
    public abstract function transformInput(array $data);
}