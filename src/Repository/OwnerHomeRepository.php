<?php

namespace App\Repository;

use App\Entity\OwnerHome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OwnerHome|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerHome|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerHome[]    findAll()
 * @method OwnerHome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerHomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OwnerHome::class);
    }

    // /**
    //  * @return OwnerHome[] Returns an array of OwnerHome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OwnerHome
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
