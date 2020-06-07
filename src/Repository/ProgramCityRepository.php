<?php

namespace App\Repository;

use App\Entity\ProgramCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgramCity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramCity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramCity[]    findAll()
 * @method ProgramCity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramCityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramCity::class);
    }

    // /**
    //  * @return ProgramCity[] Returns an array of ProgramCity objects
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
    public function findOneBySomeField($value): ?ProgramCity
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
