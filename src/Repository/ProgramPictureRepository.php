<?php

namespace App\Repository;

use App\Entity\ProgramPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgramPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramPicture[]    findAll()
 * @method ProgramPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramPicture::class);
    }

    // /**
    //  * @return ProgramPicture[] Returns an array of ProgramPicture objects
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
    public function findOneBySomeField($value): ?ProgramPicture
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
