<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form\Element;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class Element
{

    /**
     * The constructor
     *
     * @param array $options
     */
    function __construct(array $options = array())
    {
        $this->setOptions($options);
        $this->setAttributes($options);
        $this->attributes = $options;
    }


    /**
     * @var array
     */
    protected $attributes = array();

    protected $options = array();

    /**
     * The Constraints for this field from the Sf2 Validator component.
     *
     * @var array
     */
    protected $constraints = array();

    protected $name;




    /**
     * Render the tag
     *
     * @return string
     */
    abstract protected function render();

    /**
     * Set the element name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the element name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter and setter for attributes
     *
     * @param string $name The attribute name
     * @param string $value The attribute value
     * @return string
     */
    public function attr($name, $value = null)
    {

        if (null === $value) {
            return isset($this->attributes[$name]) ? $this->attributes[$name] : '';
        } else {
            $this->attributes[$name] = $value;
            return '';
        }
    }

    /**
     * Check if an attribute exists
     *
     * @param string $attr
     * @return bool
     */
    public function hasAttr($attr)
    {
        return isset($this->attributes[$attr]);
    }

    /**
     * Build up the attributes
     *
     * @return string
     */
    protected function buildAttrs()
    {

        $attrs = array();
        foreach ($this->attributes as $key => $name) {
            $attrs[] = $this->buildAttr($key);
        }
        return implode(' ', $attrs);
    }

    /**
     * Build an attribute
     *
     * @param string $name
     * @return string
     */
    protected function buildAttr($name)
    {
        return sprintf('%s="%s"', $name, $this->escape($this->attr($name)));
    }

    /**
     * Escape an attributes value
     *
     * @param string $value
     * @return string
     */
    protected function escape($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * When echo'ing this tag class, we call render
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    public function addConstraint(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * Iterate over all the set rules on this field and validate them
     * Upon failed validation we set the error message and return false
     *
     * @todo garyttierney - do we want the Form to handle validation for every input or should that be left to an element?
     *       if the latter, we should share a single Validator object between all of them.
     *
     * @return ElementValidationResult
     */
    public function validate(ValidatorInterface $validator)
    {
        // @todo - note, this will be removed in Symfony 3.0 and there's currently no way around that
        $validatorResult = $validator->validateValue($this->getValue(), $this->getConstraints());
        if(empty($validatorResult)) {
            return new ElementValidationResult(true);
        } else {
            $errorMessages = array();
            var_dump($validatorResult);
            foreach($validatorResult as $constraintViolation) {
                $errorMessages[] = array(
                    'message' => $constraintViolation->getMessageTemplate(),
                    'parameters' => $constraintViolation->getMessageParameters(),
                    'bad_value' => $constraintViolation->getInvalidValue()
                );
            }

            return new ElementValidationResult(false, $errorMessages);
        }
    }

    /**
     * Set element options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {

        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        $this->options = $options;
    }

    /**
     * Set the value of this element
     *
     * @param string $value
     * @return void
     */
    function setValue($value)
    {
        $this->attributes['value'] = $value;
    }

    /**
     * Get element value
     *
     * @return string
     */
    public function getValue()
    {
        return isset($this->attributes['value']) ? $this->attributes['value'] : '';
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get element options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

}
