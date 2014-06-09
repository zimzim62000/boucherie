<?php

namespace ZIMZIM\Bundles\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $zimzim = new User();
        $zimzim->setEmail('zimzim62000@gmail.com');
        $zimzim->setPlainPassword('170183');
        $zimzim->addRole('ROLE_ADMIN');
        $zimzim->setEnabled(true);
        $zimzim->setFirstname('Fabien');
        $zimzim->setLastname('Zimmermann');

        $om->persist($zimzim);
        $this->addReference('zimzim', $zimzim);

        $boby = new User();
        $boby->setEmail('fz@centaure-systems.fr');
        $boby->setPlainPassword('170183');
        $boby->addRole('ROLE_USER');
        $boby->setEnabled(true);
        $boby->setFirstname('Roger');
        $boby->setLastname('VAnderverke');

        $om->persist($boby);
        $this->addReference('boby', $boby);

        $om->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}