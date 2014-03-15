<?php

namespace BettingSas\Bundle\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BettingSas\Bundle\UserBundle\Document\User;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadMatchData extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = array(
            array(
                'name' => 'jobou',
                'email' => 'jobou@smile.fr',
                'group' => 'BU Helios',
                'password' => 'azerty',
                'profil' => 'ADMIN'
            )
        );

        foreach ($users as $user) {
            $entity = new User();
            $entity->setName($user['name']);
            $entity->setEmail($user['email']);
            $entity->setGroup($user['group']);
            $entity->setProfil($user['profil']);
            $entity->setSalt(md5(uniqid()));

            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($entity)
            ;
            $entity->setPassword($encoder->encodePassword($user['password'], $entity->getSalt()));

            $manager->persist($entity);

            $this->addReference('user-'.$entity->getSlug(), $entity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
