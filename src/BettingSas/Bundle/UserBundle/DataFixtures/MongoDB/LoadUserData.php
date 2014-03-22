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
                'username' => 'jobou',
                'email' => 'jobou@smile.fr',
                'password' => 'azerty',
                'profil' => 'ROLE_ADMIN'
            )
        );

        foreach ($users as $user) {
            $entity = new User();
            $entity->setUsername($user['username']);
            $entity->setEmail($user['email']);
            $entity->setProfil($user['profil']);
            $entity->setEnabled(true);

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
