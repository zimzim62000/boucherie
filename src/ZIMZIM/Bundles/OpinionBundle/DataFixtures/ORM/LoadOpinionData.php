<?php

namespace ZIMZIM\Bundles\OpinionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\OpinionBundle\Entity\Opinion;

class LoadOpinionData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $om)
    {
        $opinion = new Opinion();
        $opinion->setText('My Sur la meilleure boucherie opinion for ever');
        $opinion->setButchery($this->getReference('Butchery1'));
        $opinion->setOpinionLevel($this->getReference('level5'));
        $opinion->setUser($this->getReference('zimzim'));
        $om->persist($opinion);

        $opinion = new Opinion();
        $opinion->setText('My first opinion for Sur la meilleure boucherie');
        $opinion->setButchery($this->getReference('Butchery2'));
        $opinion->setOpinionLevel($this->getReference('level4'));
        $opinion->setUser($this->getReference('zimzim'));
        $om->persist($opinion);


        $opinion = new Opinion();
        $opinion->setText('My first Sur la meilleure boucherie for ever');
        $opinion->setButchery($this->getReference('Butchery1'));
        $opinion->setOpinionLevel($this->getReference('level5'));
        $opinion->setUser($this->getReference('boby'));
        $om->persist($opinion);

        $opinion = new Opinion();
        $opinion->setText('hola que tale in ma cassa');
        $opinion->setButchery($this->getReference('Butchery2'));
        $opinion->setOpinionLevel($this->getReference('level2'));
        $opinion->setUser($this->getReference('boby'));
        $om->persist($opinion);

        $om->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}
