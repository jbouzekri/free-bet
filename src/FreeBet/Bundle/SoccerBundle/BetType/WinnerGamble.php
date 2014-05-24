<?php

namespace FreeBet\Bundle\SoccerBundle\BetType;

use FreeBet\Bundle\GambleBundle\BetType\BetTypeInterface;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\GambleBundle\Document\Bet;

/**
 * Description of WinnerGamble
 *
 * @author jobou
 */
class WinnerGamble implements BetTypeInterface
{
    use \FreeBet\Bundle\GambleBundle\BetType\Tools\TranslatorTool;

    /**
     * Constants used in winner gamble
     */
    const LEFT_TEAM_WIN = '1';
    const RIGHT_TEAM_WIN = '2';
    const BOTH_EQUALS = 'N';

    /**
     * Choices available in gamble
     *
     * @var array
     */
    protected $choices = array(
        self::LEFT_TEAM_WIN,
        self::BOTH_EQUALS,
        self::RIGHT_TEAM_WIN
    );

    /**
     * Get the label according to the selected choice
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     * @param string $choice
     * @return string
     */
    public function getChoiceLabel(Event $event, $choice)
    {
        $label = $choice;
        switch ($choice) {
            case self::LEFT_TEAM_WIN:
                $label = $event->getLeftName();
                break;

            case self::BOTH_EQUALS:
                $label = $this->getTranslator()->trans('gamble_'.$this->getName().'_N', array(), 'gamble');
                break;

            case self::RIGHT_TEAM_WIN:
                $label = $event->getRightName();
                break;
        }

        return $label;
    }

    /**
     * Get the template use to render the gamble
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'FreeBetSoccerBundle:Gamble:winner.html.twig';
    }

    /**
     * Get choices available in gamble
     *
     * @return array
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'winner';
    }

    /**
     * {@inheritDoc}
     */
    public function getCartTemplate()
    {
        return 'FreeBetSoccerBundle:Gamble:Cart/winner.html.twig';
    }

    /**
     * {@inheritDoc}
     */
    public function processBet(Bet $bet)
    {
        $choice = $bet->getChoice();
        $winner = $bet->getEvent()->getWinner();
        if ($this->isWinner($winner, $choice)) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(Bet $bet)
    {
        return $this->getName() == $bet->getType() && in_array($bet->getChoice(), $this->getChoices());
    }

    /**
     * {@inheritDoc}
     */
    public function getDifficulty()
    {
        return 1;
    }

    /**
     * Check if the bet left team winner is a success
     *
     * @param int $winner
     * @param string $choice
     *
     * @return boolean
     */
    protected function isWinner($winner, $choice)
    {
        return $this->isLeftTeamWinner($winner, $choice)
            || $this->isRightTeamWinner($winner, $choice)
            || $this->isNoWinner($winner, $choice);
    }

    /**
     * Check if the bet left team winner is a success
     *
     * @param int $winner
     * @param string $choice
     *
     * @return boolean
     */
    protected function isLeftTeamWinner($winner, $choice)
    {
        return $winner === Event::LEFT_TEAM_WIN && $choice == self::LEFT_TEAM_WIN;
    }

    /**
     * Check if the bet right team winner is a success
     *
     * @param int $winner
     * @param string $choice
     *
     * @return boolean
     */
    protected function isRightTeamWinner($winner, $choice)
    {
        return $winner === Event::RIGHT_TEAM_WIN && $choice == self::RIGHT_TEAM_WIN;
    }

    /**
     * Check if the bet no winner is a success
     *
     * @param int $winner
     * @param string $choice
     *
     * @return boolean
     */
    protected function isNoWinner($winner, $choice)
    {
        return $winner === Event::BOTH_EQUALS && $choice == self::BOTH_EQUALS;
    }
}
