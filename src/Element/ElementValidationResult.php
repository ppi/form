<?php


namespace PPI\Form\Element;

/**
 * An object which encapsulates the result of Symfony2's Validator component.
 *
 * @package PPI\Form\Element
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class ElementValidationResult
{
    protected $successful;
    protected $errorMessages;

    public function __construct($successful, array $errorMessages = array())
    {
        $this->successful = $successful;
        $this->errorMessages = $errorMessages;
    }

    /**
     * Checks whether or not validation for the the element associated with this result was successful or not.
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->successful;
    }

    /**
     * Returns an all of the error messages for this validation result in an array, mapped as follows:
     *
     * <code>
     * array(
     *   0 => array(
     *          'message_template' => 'You must enter :min_chars characters!',
     *          'parameters' => array('min_chars' => 5),
     *          'bad_value' => 'four'
     *        ),
     *
     *   1 => ...
     *
     * )
     * </code>
     *
     * @todo - garyttierney - inject parameters into the template and create a user readable message from that.
     *
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
} 