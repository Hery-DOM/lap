<?php

namespace App\Repository;

use App\Entity\AboutWhy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AboutWhy|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutWhy|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutWhy[]    findAll()
 * @method AboutWhy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutWhyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AboutWhy::class);
    }

    // /**
    //  * @return AboutWhy[] Returns an array of AboutWhy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AboutWhy
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
