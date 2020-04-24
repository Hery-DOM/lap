<?php

namespace App\Repository;

use App\Entity\NewsletterTemp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsletterTemp|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsletterTemp|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsletterTemp[]    findAll()
 * @method NewsletterTemp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsletterTempRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsletterTemp::class);
    }

    // /**
    //  * @return NewsletterTemp[] Returns an array of NewsletterTemp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsletterTemp
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
