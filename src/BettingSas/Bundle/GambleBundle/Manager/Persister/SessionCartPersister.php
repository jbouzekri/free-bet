<?php

namespace BettingSas\Bundle\GambleBundle\Manager\Persister;

use Symfony\Component\HttpFoundation\Session\Session;

use BettingSas\Bundle\GambleBundle\Manager\CartPersisterInterface;
use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\GambleBundle\Manager\GambleCart;

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

        // Reload Event in order to authorize persist cascade later in code
        // TODO : optimize with a single query
        foreach ($gamble->getBets() as $bet) {
            $event = $cart->getManager()
                ->getRepository('BettingSas\Bundle\CompetitionBundle\Document\Event')
                ->find($bet->getEvent()->getId());
            if (!$event) {
                $gamble->removeBet($bet);
                continue;
            }

            $bet->setEvent($event);
        }

        $cart->setGamble($gamble);
    }
}
