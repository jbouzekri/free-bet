<?php

namespace FreeBet\Bundle\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FreeBet\Bundle\UserBundle\Document\User;
use FreeBet\Bundle\CompetitionBundle\DataFixtures\AbstractDataLoader;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadUserData extends AbstractDataLoader implements
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

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
    public function buildObject(array $data)
    {
        $entity = new User();
        $entity->setUsername($data['username']);
        $entity->setEmail($data['email']);
        $entity->setEnabled(true);

        if (isset($data['profil'])) {
            $entity->setRoles(array($data['profil']));
        }

        if (isset($data['organization'])) {
            $entity->setOrganization($this->getReference('organization-'.$data['organization']));
        }

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($entity)
        ;
        $entity->setPassword($encoder->encodePassword($data['password'], $entity->getSalt()));

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return array(
            array(
                'username' => 'admin',
                'email' => 'admin@freebet-sport.com',
                'password' => 'admin',
                'profil' => 'ROLE_ADMIN',
                'reference' => 'user-admin'
            ),
            array(
                'username' => 'user',
                'email' => 'user@freebet-sport.com',
                'password' => 'user',
                'reference' => 'user-user'
            )
        );
    }
}
