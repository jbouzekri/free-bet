<?php

namespace FreeBet\Bundle\UIBundle\Services;

use FreeBet\Bundle\UserBundle\Services\LoggedInUser;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Description of DateManager
 *
 * @author jobou
 */
class DateManager
{
    /**
     * @var \FreeBet\Bundle\UserBundle\Services\LoggedInUser
     */
    protected $securityContext;

    /**
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected $translator;

    /**
     * @var string
     */
    protected $defaultTimeZone;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\UserBundle\Services\LoggedInUser $securityContext
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param string $defaultTimeZone
     */
    public function __construct(LoggedInUser $securityContext, TranslatorInterface $translator, $defaultTimeZone)
    {
        $this->securityContext = $securityContext;
        $this->translator = $translator;
        $this->defaultTimeZone = $defaultTimeZone;
    }

    /**
     * Format the date for the current locale and the loaded timezone
     *
     * @param \DateTime $date
     * @param string $format
     * @param string $locale
     *
     * @return string
     *
     * @throws \LogicException
     */
    public function format(\DateTime $date, $format, $locale = null)
    {
        $dateToFormat = clone $date;

        if ($format === null) {
            $format = 'date';
        }

        $toFormat = $this->translator->trans('date.'.$format, array(), null, $locale);
        if ($toFormat === 'date.'.$format) {
            throw new \LogicException('Unknown date format : '.$format);
        }

        $dateToFormat->setTimezone($this->getTimeZone());

        return $dateToFormat->format($toFormat);
    }

    /**
     * Get the timezone for the logged in user
     *
     * @return \DateTimeZone
     */
    protected function getTimeZone()
    {
        $timeZone = new \DateTimeZone($this->defaultTimeZone);

        // Override with user configured timezone
        $user = $this->securityContext->getUser();
        if ($user !== null && $user->getTimezone() !== null) {
            $timeZone = new \DateTimeZone($user->getTimezone());
        }

        return $timeZone;
    }

    /**
     * Return an UTC DateTime
     *
     * @param string $date
     *
     * @return \DateTime
     */
    public static function getUtcDateTime($date = "now")
    {
        return new \DateTime($date, new \DateTimeZone('UTC'));
    }
}
