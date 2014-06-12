<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;


use Doctrine\ORM\EntityRepository;

class  OpinionRepository extends EntityRepository
{

    public function findLastOpinionGroupByButchery(){

        $query = $this->createQueryBuilder('o');
        $query->groupBy('o.butchery')
            ->orderBy('o.createdAt', 'DESC');

        return $query->getQuery()->setMaxResults(3)->getResult();
    }
}