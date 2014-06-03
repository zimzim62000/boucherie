<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;


use Doctrine\ORM\EntityRepository;

class  ButcheryRepository extends EntityRepository
{

    public function findByCityPostCode($address){

        $ids = array_map(function($entity){return $entity->getId();}, $address);
        $query = $this->createQueryBuilder('b');
        $query->innerJoin('b.address','a');
        $query->add('where', $query->expr()->in('a.citypostcode', ':ids'))
            ->setParameter('ids', $ids);
        return $query->getQuery()->setMaxResults(10)->getResult();
    }
}