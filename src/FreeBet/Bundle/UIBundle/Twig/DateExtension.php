<?php

namespace FreeBet\Bundle\UIBundle\Twig;

use FreeBet\Bundle\UIBundle\Services\DateManager;

class DateExtension extends \Twig_Extension
{
    /**
     * @var \FreeBet\Bundle\UIBundle\Services\DateManager
     */
    protected $dateManager;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\UIBundle\Services\DateManager $dateManager
     */
    public function __construct(DateManager $dateManager)
    {
        $this->dateManager = $dateManager;
    }

    /**
     * Extension name
     *
     * @return string
     */
    public function getName()
    {
        return 'date_extension';
    }

    /**
     * Define the filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array('date_format' => new \Twig_SimpleFilter('date_format', array($this, 'formatDate')));
    }

    /**
     * Format a date
     *
     * @param \DateTime $date
     * @param string $format
     * @param string $locale
     *
     * @return string
     */
    public function formatDate(\DateTime $date, $format, $locale = null)
    {
        return $this->dateManager->format($date, $format, $locale);
    }
}
