<?php

namespace App\Repository;

use App\Entity\AboutPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AboutPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutPicture[]    findAll()
 * @method AboutPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AboutPicture::class);
    }

    // /**
    //  * @return AboutPicture[] Returns an array of AboutPicture objects
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
    public function findOneBySomeField($value): ?AboutPicture
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
