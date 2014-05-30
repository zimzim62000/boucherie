<?php

namespace ZIMZIM\Bundles\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="butchery_address")
 * @ORM\Entity
 */
class Address
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var CityPostCode
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode", inversedBy="address")
     * @ORM\JoinColumn(name="id_citypostcode", referencedColumnName="id")
     */
    private $citypostcode;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode $citypostcode
     */
    public function setCitypostcode($citypostcode)
    {
        $this->citypostcode = $citypostcode;
    }

    /**
     * @return \ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode
     */
    public function getCitypostcode()
    {
        return $this->citypostcode;
    }



}
