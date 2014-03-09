<?php

namespace BettingSas\Bundle\GambleBundle\Component\Persister;

use Symfony\Component\HttpFoundation\Session\Session;

use BettingSas\Bundle\GambleBundle\Component\Manager\GambleCart;

/**
 * Description of SessionCartPersister
 *
 * @author jobou
 */
class SessionCartPersister implements CartPersisterInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    private $session;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Get session
     *
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * {@inheritDoc}
     */
    public function persist(GambleCart $cart)
    {
        $this->session->set('cart_gambles', $cart->getGambles());
    }

    public function load(GambleCart $cart)
    {
        $gambles = $this->session->get('cart_gambles', array());
        $cart->setGambles($gambles);
    }
}
