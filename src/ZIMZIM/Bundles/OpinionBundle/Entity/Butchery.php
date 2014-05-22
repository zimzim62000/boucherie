<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZIMZIM\Bundles\AddressBundle\Entity\Traits\AddressTrait;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Butchery
 *
 * @ORM\Table(name="butchery_butchery")
 * @ORM\Entity
 */
class Butchery
{

    use AddressTrait;

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
     * @var \ZIMZIM\Bundles\OpinionBundle\Entity\TypeButchery
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\TypeButchery")
     * @ORM\JoinColumn(name="id_type_butchery", referencedColumnName="id")
     */
    private $typeButchery;

    /**
     * @var \ZIMZIM\Bundles\OpinionBundle\Entity\TypeMeat
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\TypeMeat")
     * @ORM\JoinColumn(name="id_type_meat", referencedColumnName="id")
     */
    private $typeMeat;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\Opinion", mappedBy="butchery")
     */
    private $opinions;

    /**
     * @var \ZIMZIM\Bundles\UserBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\UserBundle\Entity\User", inversedBy="butchery")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;


    public function __construct(){
        $this->opinions = new ArrayCollection();
    }

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


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
     * @return Butchery
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
     * Set text
     *
     * @param string $text
     * @return Butchery
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $opinions
     */
    public function setOpinions($opinions)
    {
        $this->opinions = $opinions;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOpinions()
    {
        return $this->opinions;
    }

    /**
     * @param \ZIMZIM\Bundles\OpinionBundle\Entity\TypeButchery $typeButchery
     */
    public function setTypeButchery($typeButchery)
    {
        $this->typeButchery = $typeButchery;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\OpinionBundle\Entity\TypeButchery
     */
    public function getTypeButchery()
    {
        return $this->typeButchery;
    }

    /**
     * @param \ZIMZIM\Bundles\OpinionBundle\Entity\TypeMeat $typeMeat
     */
    public function setTypeMeat($typeMeat)
    {
        $this->typeMeat = $typeMeat;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\OpinionBundle\Entity\TypeMeat
     */
    public function getTypeMeat()
    {
        return $this->typeMeat;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \ZIMZIM\Bundles\OpinionBundle\Entity\ZIMZIM\Bundles\UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \ZIMZIM\Bundles\OpinionBundle\Entity\ZIMZIM\Bundles\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


}
