<?php

namespace App\Repository;

use App\Entity\ProgramProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgramProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramProperty[]    findAll()
 * @method ProgramProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramProperty::class);
    }

    // /**
    //  * @return ProgramProperty[] Returns an array of ProgramProperty objects
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
    public function findOneBySomeField($value): ?ProgramProperty
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
