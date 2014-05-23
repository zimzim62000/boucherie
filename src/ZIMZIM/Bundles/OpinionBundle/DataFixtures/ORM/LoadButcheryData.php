<?php

namespace ZIMZIM\Bundles\OpinionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\OpinionBundle\Entity\Butchery;

class LoadButcheryData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $om)
    {
        $butchery = new Butchery();
        $butchery->setName('My first butchery');
        $butchery->setText('The best of the best butchery for ever');
        $butchery->setTypeMeat($this->getReference('TypeMeat1'));
        $butchery->setTypeButchery($this->getReference('TypeButchery1'));
        $this->addReference('Butchery1', $butchery);
        $om->persist($butchery);

        $om->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
