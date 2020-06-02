<?php

namespace App\Repository;

use App\Entity\ProgramCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgramCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramCategory[]    findAll()
 * @method ProgramCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramCategory::class);
    }

    // /**
    //  * @return ProgramCategory[] Returns an array of ProgramCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProgramCategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
