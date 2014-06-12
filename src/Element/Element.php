<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form\Element;

abstract class Element
{

    /**
     * @var array
     */
    protected $attributes = array();

    /**
     * The rules for this field
     *
     * @var array
     */
    protected $rules = array();


    /**
     * Render the tag
     *
     * @return void
     */
    abstract protected function render();

    /**
     * Getter and setter for attributes
     *
     * @param string $name The attribute name
     * @param string $value The attribute value
     * @return mixed
     */
    public function attr($name, $value = null)
    {

        if (null === $value) {
            return isset($this->attributes[$name]) ? $this->attributes[$name] : '';
        } else {
            $this->attributes[$name] = $value;
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

    /**
     * Set a rule on this field
     *
     * @param string $ruleMessage The Message for this rule
     * @param string $ruleType The rule type
     * @param string $ruleValue The rule value (optional)
     * @return $this
     */
    public function setRule($ruleMessage, $ruleType, $ruleValue = null)
    {
        $className = 'PPI\\Form\\Rule\\' . ucfirst($ruleType);
        $ruleClass = new $className();
        $ruleClass->setRuleMessage($ruleMessage);
        if ($ruleValue !== null) {
            $ruleClass->setRuleData($ruleValue);
        }
        $this->rules[$ruleType] = $ruleClass;
        return $this;
    }

    /**
     * Get the rule on this field
     *
     * @return array
     */
    public function getRule($ruleType)
    {
        return isset($this->rules[$ruleType]) ? $this->rules[$ruleType] : null;
    }

    /**
     * Iterate over all the set rules on this field and validate them
     * Upon failed validation we set the error message and return false
     *
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules as $rule) {
            if ($rule->validate($this->getValue()) === false) {
                $this->setErrorMessage($rule->getRuleMessage());
                return false;
            }
        }
        return true;
    }

    /**
     * Set the error message upon failed validation
     *
     * @param string $message
     * @return void
     */
    public function setErrorMessage($message)
    {
        $this->errorMessage = $message;
    }

    /**
     * Get the error message set by a failed validation rule
     *
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Check if a validation has failed or not.
     *
     * @return bool
     */
    public function hasErrored()
    {
        return $this->errorMessage !== null;
    }


}