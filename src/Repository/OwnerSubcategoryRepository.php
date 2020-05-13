<?php

namespace App\Repository;

use App\Entity\OwnerSubcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OwnerSubcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerSubcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerSubcategory[]    findAll()
 * @method OwnerSubcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerSubcategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OwnerSubcategory::class);
    }

    // /**
    //  * @return OwnerSubcategory[] Returns an array of OwnerSubcategory objects
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
    public function findOneBySomeField($value): ?OwnerSubcategory
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
