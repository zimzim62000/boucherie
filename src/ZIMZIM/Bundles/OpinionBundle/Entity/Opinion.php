<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Opinion
 *
 * @ORM\Table(name="butchery_opinion")
 * @ORM\Entity
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
     * @var ZIMZIM\Bundles\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\UserBundle\Entity\User", inversedBy="opinions")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var OpinionLevel
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel")
     * @ORM\JoinColumn(name="id_opinion_level", referencedColumnName="id")
     */
    private $opinionLevel;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="ZIMZIM\Bundles\OpinionBundle\Entity\Butchery", inversedBy="opinions")
     * @ORM\JoinColumn(name="id_butchery", referencedColumnName="id")
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

}
