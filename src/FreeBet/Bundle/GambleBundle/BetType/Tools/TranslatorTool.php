<?php

namespace FreeBet\Bundle\GambleBundle\BetType\Tools;

use Symfony\Component\Translation\Translator;

/**
 * Description of TranslatorTool
 *
 * @author jobou
 */
trait TranslatorTool
{
    /**
     * @var \Symfony\Component\Translation\Translator
     */
    protected $translator;

    /**
     * @param \Symfony\Component\Translation\Translator $translator
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return \Symfony\Component\Translation\Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }
}
