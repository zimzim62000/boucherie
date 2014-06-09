<?php

namespace ZIMZIM\Bundles\AddressBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * CityPostcode
 *
 * @ORM\Table(name="butchery_city_postcode", indexes={@ORM\Index(name="unik_idx", columns={"unik"})})
 * @ORM\Entity(repositoryClass="CityPostCodeRepository")
 */
class CityPostCode{

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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $cp;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;


    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;


    /**
     * @var string
     *
     * @ORM\Column(name="county", type="string", length=255)
     */
    private $county;


    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255)
     */
    private $longitude;


    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="unik", type="string", length=255, unique=true)
     */
    private $unik;

    /**
     * @var KM
     */
    private $distance;

    /**
     * @var string
     *
     * @ORM\Column(name="main", type="boolean")
     */
    private $main;


    public function __toString(){
        return $this->city.' '.$this->cp;
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\AddressBundle\Entity\Address", mappedBy="citypostcode")
     */
    private $address;


    public function __construct(){
        $this->address = new ArrayCollection();
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $county
     */
    public function setCounty($county)
    {
        $this->county = $county;
    }

    /**
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param string $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $unik
     */
    public function setUnik($unik)
    {
        $this->unik = $unik;
    }

    /**
     * @return string
     */
    public function getUnik()
    {
        return $this->unik;
    }

    /**
     * @param \ZIMZIM\Bundles\AddressBundle\Entity\KM $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return \ZIMZIM\Bundles\AddressBundle\Entity\KM
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $main
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * @return string
     */
    public function getMain()
    {
        return $this->main;
    }




    public function getData(){

        return array(
            'id' => $this->getId(),
            'city' => $this->getCity(),
            'cp' => $this->getCp(),
            'county' => $this->getCounty(),
            'region' => $this->getRegion(),
            'longitude' => $this->getLongitude(),
            'latitude' => $this->getLatitude(),
            'unik' => $this->getUnik()
        );
    }


}