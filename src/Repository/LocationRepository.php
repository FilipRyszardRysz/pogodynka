<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function save(Location $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Location $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function findByCountryAndCity(String $country, String $city){
        $qb = $this->createQueryBuilder('l');
        $qb->where('l.country = :country')
            ->setParameter('country', $country)
            ->andWhere('l.city = :city')
            ->setParameter('city', $city);

        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();
        return $result;
    }
}