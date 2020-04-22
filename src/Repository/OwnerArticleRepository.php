<?php

namespace App\Repository;

use App\Entity\OwnerArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OwnerArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerArticle[]    findAll()
 * @method OwnerArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OwnerArticle::class);
    }

    // /**
    //  * @return OwnerArticle[] Returns an array of OwnerArticle objects
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
    public function findOneBySomeField($value): ?OwnerArticle
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
