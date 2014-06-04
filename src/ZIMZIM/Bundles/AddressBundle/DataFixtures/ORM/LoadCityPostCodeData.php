<?php

namespace ZIMZIM\Bundles\OpinionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadCityPostCodeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

    public function load(ObjectManager $om)
    {
        /** @var $loader ZIMZIM\Bundles\AddressBundle\Loader\CityPostCode */
        $loader = $this->container->get('zimzim_address.loader.loader_city_postcode');

        $loader->load($om);
    }

    public function getOrder()
    {
        return 5;
    }
}
