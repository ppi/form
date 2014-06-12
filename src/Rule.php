<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form;

abstract class Rule
{

    /**
     * The abritary param
     *
     * @var array
     */
    protected $ruleData = null;

    /**
     * The message for this rule
     *
     * @var null
     */
    protected $ruleMessage = null;

    /**
     * Validates data by this rule
     *
     * @param mixed $data
     * @return boolean
     */
    abstract public function validate($data);

    /**
     * The Constructor
     *
     * @param mixed $param
     */
    public function __construct($ruleData = null)
    {

        if ($ruleData !== null) {
            $this->setParam($ruleData);
        }
    }

    /**
     * Get the rule param
     *
     * @return string
     */
    public function getRuleData()
    {
        return $this->ruleData;
    }

    /**
     * Sets the rules value
     *
     * @param mixed $value
     * @return void
     */
    public function setRuleData($value)
    {
        $this->ruleData = $value;
    }

    /**
     * Set the rule message
     *
     * @param string $message
     * @return void
     */
    public function setRuleMessage($message)
    {
        $this->ruleMessage = $message;
    }

    /**
     * Get the rule message
     *
     * @return string|null
     */
    public function getRuleMessage()
    {
        return $this->ruleMessage;
    }

}
