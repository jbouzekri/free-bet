<?php

namespace BettingSas\Bundle\GambleBundle\Manager;

use BettingSas\Bundle\GambleBundle\Component\Manager\GambleCart;

/**
 * Description of GambleCartValidator
 *
 * @author jobou
 */
class GambleCartValidator
{
    /**
     * @var array
     */
    protected $globalValidators = array();

    /**
     * @var array
     */
    protected $globalErrors;

    /**
     * @var array
     */
    protected $errors;

    /**
     * Validate a cart
     *
     * @param \BettingSas\Bundle\GambleBundle\Component\Manager\GambleCart $cart
     *
     * @return boolean
     */
    public function validate(GambleCart $cart)
    {
        $this->applyGlobalValidators($cart);

        return true;
    }

    protected function applyGlobalValidators(GambleCart $cart)
    {
        $this->applyValidators($cart, $this->getGlobalValidators());
    }

    protected function getGlobalValidators()
    {
        return $this->globalValidators;
    }

    protected function applyValidators(GambleCart $cart, $validators)
    {
        foreach ($this->globalValidators as $validator)
        {
            $validator->validate($cart);
        }
    }
}
