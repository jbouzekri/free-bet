<?php

namespace BettingSas\Bundle\CompetitionBundle\Twig;

class StringExtension extends \Twig_Extension
{
    /**
     * Extension name
     *
     * @return string
     */
    public function getName()
    {
        return 'string_extension';
    }

    /**
     * Define the filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array('slugify' => new \Twig_SimpleFilter($this, array($this, 'slugify')));
    }

    /**
     * Slugify a string
     *
     * @param string $string
     *
     * @return string
     */
    public function slugify($string)
    {
        // Remove accents from characters
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', \Normalizer::normalize($string, \Normalizer::FORM_D));

        // Everything lowercase
        $string = strtolower($string);

        // Replace all non-word characters by dashes
        $string = preg_replace("/\W/", "-", $string);

        // Replace double dashes by single dashes
        $string = preg_replace("/-+/", '-', $string);

        // Trim dashes from the beginning and end of string
        $string = trim($string, '-');

        return $string;
    }
}
