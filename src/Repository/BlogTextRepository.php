<?php

namespace App\Repository;

use App\Entity\BlogText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogText|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogText|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogText[]    findAll()
 * @method BlogText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogText::class);
    }

    // /**
    //  * @return BlogText[] Returns an array of BlogText objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogText
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
