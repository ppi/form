<?php
/**
 * This file is part of the PPI Framework.
 *
 * @copyright  Copyright (c) 2011-2013 Paul Dragoonis <paul@ppi.io>
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       http://www.ppi.io
 */
namespace PPI\Form\Rule;

use PPI\Form\Rule\Rule as BaseRule;

class Maxlength extends BaseRule
{

    /**
     * Validate our maxlength rule
     *
     * @param string $data
     * @return bool
     */
    public function validate($data)
    {
        return strlen(trim($data)) <= $this->getRuleData();
    }

}
