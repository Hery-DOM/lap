<?php

namespace App\Repository;

use App\Entity\MainCriteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MainCriteria|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainCriteria|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainCriteria[]    findAll()
 * @method MainCriteria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainCriteriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainCriteria::class);
    }

    // /**
    //  * @return MainCriteria[] Returns an array of MainCriteria objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainCriteria
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
