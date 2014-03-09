<?php

namespace BettingSas\Bundle\GambleBundle\Component\Persister;

use Symfony\Component\HttpFoundation\Session\Session;

use BettingSas\Bundle\GambleBundle\Document\Gamble;
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
    public function persist(Gamble $gamble)
    {
        $this->session->set('cart_gamble', $gamble);
    }

    /**
     * {@inheritDoc}
     */
    public function load(GambleCart $cart)
    {
        $gamble = $this->session->get('cart_gamble', new Gamble());
        $cart->setGamble($gamble);
    }
}
