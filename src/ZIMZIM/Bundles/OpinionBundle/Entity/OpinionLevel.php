<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpinionLevel
 *
 * @ORM\Table(name="butchery_opinion_level")
 * @ORM\Entity
 */
class OpinionLevel
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="stars", type="integer")
     */
    private $stars;

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
     * Set name
     *
     * @param string $name
     * @return OpinionLevel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $stars
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * @return string
     */
    public function getStars()
    {
        return $this->stars;
    }


}
