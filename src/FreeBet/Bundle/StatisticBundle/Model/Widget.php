<?php

namespace FreeBet\Bundle\StatisticBundle\Model;

/**
 * Description of Widget
 *
 * @author jobou
 */
abstract class Widget
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return \FreeBet\Bundle\StatisticBundle\Model\Widget
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
