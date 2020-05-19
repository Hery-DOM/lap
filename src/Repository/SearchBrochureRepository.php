<?php

namespace App\Repository;

use App\Entity\SearchBrochure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SearchBrochure|null find($id, $lockMode = null, $lockVersion = null)
 * @method SearchBrochure|null findOneBy(array $criteria, array $orderBy = null)
 * @method SearchBrochure[]    findAll()
 * @method SearchBrochure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchBrochureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SearchBrochure::class);
    }

    // /**
    //  * @return SearchBrochure[] Returns an array of SearchBrochure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SearchBrochure
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
