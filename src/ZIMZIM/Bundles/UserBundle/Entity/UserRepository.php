<?php

namespace ZIMZIM\Bundles\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use ZIMZIM\Bundles\OpinionBundle\Entity\Butchery;

class UserRepository extends EntityRepository
{
    public function findOpinionWithButchery(User $user, Butchery $butchery)
    {
        $query = $this->createQueryBuilder('u');
        $query->join('u.opinions', 'o')
            ->join('o.butchery', 'b')
            ->where('b.id = :idbutchery')
            ->andWhere('u.id = :iduser')
            ->setParameter('iduser', $user->getId())
            ->setParameter('idbutchery', $butchery->getId());

            return $query->getQuery()->getResult();
    }
}