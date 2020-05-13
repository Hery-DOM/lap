<?php

namespace App\Repository;

use App\Entity\OwnerCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OwnerCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerCategory[]    findAll()
 * @method OwnerCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OwnerCategory::class);
    }

    // /**
    //  * @return OwnerCategory[] Returns an array of OwnerCategory objects
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
    public function findOneBySomeField($value): ?OwnerCategory
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
