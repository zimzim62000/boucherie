<?php

namespace ZIMZIM\Bundles\AddressBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class CityPostCodeRepository extends EntityRepository
{
    public function findByPostCodeOrCity($city, $postcode, $queryBuilder = false)
    {

        $city = $city . '%';
        $postcode = $postcode . '%';
        $query = $this->createQueryBuilder('c');
        $query->where('c.city LIKE :city')
            ->OrWhere('c.cp LIKE :postcode')
            ->setParameter('city', $city)
            ->setParameter('postcode', $postcode);

        if($queryBuilder){
            $return = $query->setMaxResults(10);
        }else{
            $return = $query->getQuery()->setMaxResults(10)->getResult();
        }
        return $return;
    }


    public function findByUnikAndDistance(CityPostCode $entity, $distance, $limit = 10)
    {
        $formule = "CAST(6366*acos(cos(radians(" . $entity->getLatitude(
            ) . "))*cos(radians(b.latitude))*cos(radians(b.longitude)-radians(" . $entity->getLongitude(
            ) . "))+sin(radians(" . $entity->getLatitude() . "))*sin(radians(b.latitude))) AS SIGNED INTEGER)";

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode', 'b');
        $rsm->addFieldResult('b', 'city', 'city');
        $rsm->addFieldResult('b', 'cp', 'cp');
        $rsm->addFieldResult('b', 'id', 'id');
        $rsm->addScalarResult('distance', 'distance');
        $sql = "
        SELECT b.id as id, b.city as city, b.cp as cp, " . $formule . " as distance
        FROM butchery_city_postcode as b WHERE " . $formule . " <= " . $distance . " OR " . $formule . " IS NULL
        ORDER BY distance ASC LIMIT 0," . $limit;
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);

        return $query->getResult();

    }
}