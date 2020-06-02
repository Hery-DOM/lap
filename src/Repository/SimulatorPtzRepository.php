<?php

namespace App\Repository;

use App\Entity\SimulatorPtz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SimulatorPtz|null find($id, $lockMode = null, $lockVersion = null)
 * @method SimulatorPtz|null findOneBy(array $criteria, array $orderBy = null)
 * @method SimulatorPtz[]    findAll()
 * @method SimulatorPtz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SimulatorPtzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SimulatorPtz::class);
    }

    // /**
    //  * @return SimulatorPtz[] Returns an array of SimulatorPtz objects
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
    public function findOneBySomeField($value): ?SimulatorPtz
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
