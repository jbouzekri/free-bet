<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use BettingSas\Bundle\SoccerBundle\Document\Match;

/**
 * Description of LoadMatchData
 *
 * @author jobou
 */
class LoadMatchData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $matchs = array(
            /***********************/
            // Group A
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'A',
                'left_name' => 'Brazil',
                'right_name' => 'Croatia',
                'date' => '1402603200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'A',
                'left_name' => 'Mexico',
                'right_name' => 'Cameroon',
                'date' => '1402675200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'A',
                'left_name' => 'Brazil',
                'right_name' => 'Mexico',
                'date' => '1403031600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'A',
                'left_name' => 'Cameroon',
                'right_name' => 'Croatia',
                'date' => '1403128800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'A',
                'left_name' => 'Cameroon',
                'right_name' => 'Brazil',
                'date' => '1403553600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'A',
                'left_name' => 'Croatia',
                'right_name' => 'Mexico',
                'date' => '1403553600'
            ),

            /***********************/
            // Group B
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Spain',
                'right_name' => 'Netherlands',
                'date' => '1402686000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Chile',
                'right_name' => 'Australia',
                'date' => '1402696800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Spain',
                'right_name' => 'Chile',
                'date' => '1403118000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Australia',
                'right_name' => 'Netherlands',
                'date' => '1403107200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Australia',
                'right_name' => 'Spain',
                'date' => '1403107200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Netherlands',
                'right_name' => 'Chile',
                'date' => '1403107200'
            ),

            /***********************/
            // Group C
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'C',
                'left_name' => 'Colombia',
                'right_name' => 'Greece',
                'date' => '1402761600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'C',
                'left_name' => 'Côte d\'Ivoire',
                'right_name' => 'Japan',
                'date' => '1402794000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'C',
                'left_name' => 'Colombia',
                'right_name' => 'Côte d\'Ivoire',
                'date' => '1403193600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'C',
                'left_name' => 'Japan',
                'right_name' => 'Greece',
                'date' => '1403215200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'C',
                'left_name' => 'Japan',
                'right_name' => 'Colombia',
                'date' => '1403640000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'C',
                'left_name' => 'Greece',
                'right_name' => 'Côte d\'Ivoire',
                'date' => '1403640000'
            ),

            /***********************/
            // Group D
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'D',
                'left_name' => 'Uruguay',
                'right_name' => 'Costa Rica',
                'date' => '1402772400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'D',
                'left_name' => 'England',
                'right_name' => 'Italy',
                'date' => '1402783200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'D',
                'left_name' => 'Uruguay',
                'right_name' => 'England',
                'date' => '1403204400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'D',
                'left_name' => 'Italy',
                'right_name' => 'Costa Rica',
                'date' => '1403280000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'D',
                'left_name' => 'Italy',
                'right_name' => 'Uruguay',
                'date' => '1403625600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'D',
                'left_name' => 'Costa Rica',
                'right_name' => 'England',
                'date' => '1403625600'
            ),

            /***********************/
            // Group E
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'E',
                'left_name' => 'Switzerland',
                'right_name' => 'Ecuador',
                'date' => '1402848000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'E',
                'left_name' => 'France',
                'right_name' => 'Honduras',
                'date' => '1402858800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'E',
                'left_name' => 'Switzerland',
                'right_name' => 'France',
                'date' => '1403290800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'E',
                'left_name' => 'Honduras',
                'right_name' => 'Ecuador',
                'date' => '1403301600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'E',
                'left_name' => 'Honduras',
                'right_name' => 'Switzerland',
                'date' => '1403726400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'E',
                'left_name' => 'Ecuador',
                'right_name' => 'France',
                'date' => '1403726400'
            ),


            /***********************/
            // Group F
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'F',
                'left_name' => 'Argentina',
                'right_name' => 'Bosnia and Herzegovina',
                'date' => '1402869600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'F',
                'left_name' => 'Iran',
                'right_name' => 'Nigeria',
                'date' => '1402945200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'F',
                'left_name' => 'Argentina',
                'right_name' => 'Iran',
                'date' => '1403366400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'F',
                'left_name' => 'Nigeria',
                'right_name' => 'Bosnia and Herzegovina',
                'date' => '1403388000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'F',
                'left_name' => 'Nigeria',
                'right_name' => 'Argentina',
                'date' => '1403712000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'F',
                'left_name' => 'Bosnia and Herzegovina',
                'right_name' => 'Iran',
                'date' => '1403712000'
            ),


            /***********************/
            // Group G
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'G',
                'left_name' => 'Germany',
                'right_name' => 'Portugal',
                'date' => '1402934400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'G',
                'left_name' => 'Ghana',
                'right_name' => 'USA',
                'date' => '1402956000'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'G',
                'left_name' => 'Germany',
                'right_name' => 'Ghana',
                'date' => '1403377200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'G',
                'left_name' => 'USA',
                'right_name' => 'Portugal',
                'date' => '1403474400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'G',
                'left_name' => 'USA',
                'right_name' => 'Germany',
                'date' => '1403798400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'G',
                'left_name' => 'Portugal',
                'right_name' => 'Ghana',
                'date' => '1403798400'
            ),

            /***********************/
            // Group H
            /***********************/
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'H',
                'left_name' => 'Belgium',
                'right_name' => 'Algeria',
                'date' => '1403020800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'H',
                'left_name' => 'Russia',
                'right_name' => 'Korea Republic',
                'date' => '1403042400'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'H',
                'left_name' => 'Belgium',
                'right_name' => 'Russia',
                'date' => '1403452800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'H',
                'left_name' => 'Korea Republic',
                'right_name' => 'Algeria',
                'date' => '1403463600'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'H',
                'left_name' => 'Korea Republic',
                'right_name' => 'Belgium',
                'date' => '1403812800'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'H',
                'left_name' => 'Algeria',
                'right_name' => 'Russia',
                'date' => '1403812800'
            ),
        );

        $worldCup2014 = $this->getReference('world-cup-2014');

        foreach ($matchs as $match) {
            $entity = new Match();
            $entity->setPhaseOrder($match['phase_order']);
            $entity->setPhase($match['phase']);
            $entity->setGroup($match['group']);
            $entity->setLeftName($match['left_name']);
            $entity->setRightName($match['right_name']);
            $entity->setDate($match['date']);
            $entity->setCompetition($worldCup2014);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}