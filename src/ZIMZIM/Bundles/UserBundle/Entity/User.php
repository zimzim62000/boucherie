<?php

namespace ZIMZIM\Bundles\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use ZIMZIM\Bundles\AddressBundle\Entity\Traits\AddressTrait;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Table(name="butchery_user")
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    use AddressTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", length=255, nullable=true)
     */
    private $google_id;

    /**
     * @var string
     *
     * @ORM\Column(name="google_access_token", type="string", length=255, nullable=true)
     */
    private $googleAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebook_id;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
     */
    private $facebookAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_id", type="string", length=255, nullable=true)
     */
    private $twitter_id;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_access_token", type="string", length=255, nullable=true)
     */
    private $twitterAccessToken;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\Opinion", mappedBy="user")
     */
    private $opinions;

    /**
     * @var \ZIMZIM\Bundles\OpinionBundle\Entity\Butchery
     *
     * @ORM\OneToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\Butchery", mappedBy="user")
     */
    private $butchery;


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

    public function __construct(){

        parent::__construct();

        $this->opinions = new ArrayCollection();
        //$this->butchery = new ArrayCollection();
    }

    /**
     * @param string $googleAccessToken
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->googleAccessToken = $googleAccessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->googleAccessToken;
    }
    /**
     *
     * @param mixed $google_id
     */
    public function setGoogleId($google_id)
    {
        $this->google_id = $google_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @ORM\PrePersist
     */
    public function createUser()
    {
        $this->addRole('ROLE_USER');
    }

    public function setEmail($email){
        parent::setEmail($email);

        if($this->getUsername() === null){
            $this->setUsername($email);
        }
    }

    /**
     * @param string $facebookAccessToken
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    /**
     * @param string $facebook_id
     */
    public function setFacebookId($facebook_id)
    {
        $this->facebook_id = $facebook_id;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * @param string $twitterAccessToken
     */
    public function setTwitterAccessToken($twitterAccessToken)
    {
        $this->twitterAccessToken = $twitterAccessToken;
    }

    /**
     * @return string
     */
    public function getTwitterAccessToken()
    {
        return $this->twitterAccessToken;
    }

    /**
     * @param string $twitter_id
     */
    public function setTwitterId($twitter_id)
    {
        $this->twitter_id = $twitter_id;
    }

    /**
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitter_id;
    }


    public function getFullName(){
        return $this->firstname.' '.$this->lastname;
    }

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



}
