<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Opinion
 *
 * @ORM\Table(name="butchery_opinion")
 * @ORM\Entity
 * @UniqueEntity(fields = {"user", "butchery"}, message="form.opinion.opiniontype.uniqueentity")
 */
class Opinion
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
     * @var \ZIMZIM\Bundles\UserBundle\Entity\User
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\UserBundle\Entity\User", inversedBy="opinions")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var \ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel")
     * @ORM\JoinColumn(name="id_opinion_level", referencedColumnName="id", nullable=false)
     */
    private $opinionLevel;

    /**
     * @var \ZIMZIM\Bundles\OpinionBundle\Entity\Butchery
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\Butchery", inversedBy="opinions")
     * @ORM\JoinColumn(name="id_butchery", referencedColumnName="id", nullable=false)
     */
    private $butchery;

    /**
     * @var String
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    private $text;


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
     * @param \ZIMZIM\Bundles\OpinionBundle\Entity\Butchery $butchery
     */
    public function setButchery($butchery)
    {
        $this->butchery = $butchery;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\OpinionBundle\Entity\Butchery
     */
    public function getButchery()
    {
        return $this->butchery;
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel $opinionLevel
     */
    public function setOpinionLevel($opinionLevel)
    {
        $this->opinionLevel = $opinionLevel;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel
     */
    public function getOpinionLevel()
    {
        return $this->opinionLevel;
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
     * @param \ZIMZIM\Bundles\UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param String $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return String
     */
    public function getText()
    {
        return $this->text;
    }
}
