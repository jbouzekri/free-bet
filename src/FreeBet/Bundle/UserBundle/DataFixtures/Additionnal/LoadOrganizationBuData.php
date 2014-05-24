<?php

namespace FreeBet\Bundle\UserBundle\DataFixtures\Additionnal;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadOrganizationBuData extends LoadOrganizationData implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return array(
            'bu-helios' => array(
                'name' => 'BU Helios',
                'reference' => 'organization-bu-helios'
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 105;
    }
}
