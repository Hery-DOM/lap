<?php

namespace App\Repository;

use App\Entity\Confidentiality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Confidentiality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Confidentiality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Confidentiality[]    findAll()
 * @method Confidentiality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfidentialityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Confidentiality::class);
    }

    // /**
    //  * @return Confidentiality[] Returns an array of Confidentiality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Confidentiality
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
