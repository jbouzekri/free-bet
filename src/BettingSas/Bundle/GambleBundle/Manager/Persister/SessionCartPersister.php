<?php

namespace BettingSas\Bundle\GambleBundle\Manager\Persister;

use Symfony\Component\HttpFoundation\Session\Session;
use BettingSas\Bundle\GambleBundle\Manager\CartPersisterInterface;
use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\GambleBundle\Manager\GambleCart;
use BettingSas\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface;

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
     * @var \BettingSas\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface
     */
    private $eventRepository;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface $eventRepository
     */
    public function __construct(Session $session, EventRepositoryInterface $eventRepository)
    {
        $this->session = $session;
        $this->eventRepository = $eventRepository;
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
            $event = $this->eventRepository->find($bet->getEvent()->getId());
            if (!$event) {
                $gamble->removeBet($bet);
                continue;
            }

            $bet->setEvent($event);
        }

        $cart->setGamble($gamble);
    }
}
