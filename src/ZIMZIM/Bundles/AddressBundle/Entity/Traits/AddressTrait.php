<?php

namespace ZIMZIM\Bundles\AddressBundle\Entity\Traits;


use ZIMZIM\Bundles\AddressBundle\Entity\Address;

trait AddressTrait{

    /**
     * @var Address
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\AddressBundle\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_address", referencedColumnName="id")
     */
    private $address;

    /**
     * @param Address $address
     *
     * @return $this
     */
    public function setAddress(Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

}