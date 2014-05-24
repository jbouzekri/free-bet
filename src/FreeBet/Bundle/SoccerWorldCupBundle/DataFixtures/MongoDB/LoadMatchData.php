<?php

namespace FreeBet\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use FreeBet\Bundle\SoccerBundle\Document\Match;
use FreeBet\Bundle\CompetitionBundle\DataFixtures\AbstractDataLoader;

/**
 * Description of LoadMatchData
 *
 * @author jobou
 */
class LoadMatchData extends AbstractDataLoader implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        $worldCup2014 = $this->getReference('world-cup-2014');

        $entity = new Match();
        $entity->setPhaseOrder($data['phase_order']);
        $entity->setPhase($data['phase']);
        $entity->setGroup($data['group']);
        if (isset($data['left_name'])) {
            $entity->setLeftName($data['left_name']);
        }
        if (isset($data['right_name'])) {
            $entity->setRightName($data['right_name']);
        }
        $entity->setDate(\DateTime::createFromFormat('U', $data['date']));
        //$entity->setDate(new \DateTime('-1000 seconds'));
        $entity->setCompetition($worldCup2014);
        $entity->setProcessed(false);

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return array_merge(
            $this->getGroupAData(),
            $this->getGroupBData(),
            $this->getGroupCData(),
            $this->getGroupDData(),
            $this->getGroupEData(),
            $this->getGroupFData(),
            $this->getGroupGData(),
            $this->getGroupGData(),
            $this->getGroupHData(),
            $this->getSixteenData(),
            $this->getQuarterData(),
            $this->getSemiData(),
            $this->getFinalData()
        );
    }


    /**
     * Get group A data
     *
     * @return array
     */
    public function getGroupAData()
    {
        return array(
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
            )
        );
    }

    /**
     * Get group B data
     *
     * @return array
     */
    public function getGroupBData()
    {
        return array(
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
                'date' => '1403539200'
            ),
            array(
                'phase_order' => 1,
                'phase' => 'group',
                'group' => 'B',
                'left_name' => 'Netherlands',
                'right_name' => 'Chile',
                'date' => '1403539200'
            )
        );
    }

    /**
     * Get group C data
     *
     * @return array
     */
    public function getGroupCData()
    {
        return array(
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
            )
        );
    }

    /**
     * Get group D data
     *
     * @return array
     */
    public function getGroupDData()
    {
        return array(
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
            )
        );
    }

    /**
     * Get group E data
     *
     * @return array
     */
    public function getGroupEData()
    {
        return array(
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
            )
        );
    }

    /**
     * Get group F data
     *
     * @return array
     */
    public function getGroupFData()
    {
        return array(
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
            )
        );
    }


    /**
     * Get group G data
     *
     * @return array
     */
    public function getGroupGData()
    {
        return array(
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
            )
        );
    }

    /**
     * Get group H data
     *
     * @return array
     */
    public function getGroupHData()
    {
        return array(
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
            )
        );
    }

    /**
     * Get sixteen data
     *
     * @return array
     */
    public function getSixteenData()
    {
        return array(
            /***********************/
            // Sixteen
            /***********************/
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '1',
                'date' => '1403971200'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '2',
                'date' => '1403985600'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '3',
                'date' => '1404057600'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '4',
                'date' => '1404072000'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '5',
                'date' => '1404144000'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '6',
                'date' => '1404158400'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '7',
                'date' => '1404230400'
            ),
            array(
                'phase_order' => 2,
                'phase' => 'sixteen',
                'group' => '8',
                'date' => '1404244800'
            )
        );
    }

    /**
     * Get quarter data
     *
     * @return array
     */
    public function getQuarterData()
    {
        return array(
            /***********************/
            // Quarter
            /***********************/
            array(
                'phase_order' => 3,
                'phase' => 'quarter',
                'group' => '1',
                'date' => '1404489600'
            ),
            array(
                'phase_order' => 3,
                'phase' => 'quarter',
                'group' => '2',
                'date' => '1404504000'
            ),
            array(
                'phase_order' => 3,
                'phase' => 'quarter',
                'group' => '3',
                'date' => '1404576000'
            ),
            array(
                'phase_order' => 3,
                'phase' => 'quarter',
                'group' => '4',
                'date' => '1404590400'
            )
        );
    }

    /**
     * Get semi data
     *
     * @return array
     */
    public function getSemiData()
    {
        return array(
            /***********************/
            // semi
            /***********************/
            array(
                'phase_order' => 4,
                'phase' => 'semi',
                'group' => '1',
                'date' => '1404849600'
            ),
            array(
                'phase_order' => 4,
                'phase' => 'semi',
                'group' => '2',
                'date' => '1404936000'
            )
        );
    }

    /**
     * Get final data
     *
     * @return array
     */
    public function getFinalData()
    {
        return array(
            /***********************/
            // playoff
            /***********************/
            array(
                'phase_order' => 5,
                'phase' => 'playoff',
                'group' => '1',
                'date' => '1405195200'
            ),

            /***********************/
            // final
            /***********************/
            array(
                'phase_order' => 6,
                'phase' => 'final',
                'group' => '1',
                'date' => '1405278000'
            ),
        );
    }
}
