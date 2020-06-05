<?php

namespace App\Repository;

use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Program|null find($id, $lockMode = null, $lockVersion = null)
 * @method Program|null findOneBy(array $criteria, array $orderBy = null)
 * @method Program[]    findAll()
 * @method Program[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Program::class);
    }

    public function findByFilter($name)
    {
        return $this->createQueryBuilder('p')
                    ->select('p')
                    ->leftJoin('p.filter', 'f')
                    ->addSelect('f')
                    ->leftJoin('p.program_picture', 'pic')
                    ->addSelect('pic')
                    ->where('f.name = :name')
                    ->setParameter('name',$name)
                    ->andWhere('p.published = :bool')
                    ->setParameter('bool',true)
                    ->getQuery()
                    ->getResult();
    }


    public function findBySearch($city, $typo, $priceMin, $priceMax, $surfaceMin, $surfaceMax, $handicap)
    {
        $search = $this->createQueryBuilder('p')
                        ->select('p')
                        ->leftJoin('p.criteria', 'c')
                        ->addSelect('c')
                        ->where('p.published = :published')
                        ->setParameter('published', true);

        // firsts criteria
        if(!empty($city)){
            $search->andwhere('p.city = :city')
                    ->setParameter('city', $city);
        }
        if(!empty($typo)){
            $search->andwhere('p.typologie = :typo')
                ->setParameter('typo', $typo);
        }
//        if(!empty($priceMin)){
//            $search->andwhere('p.price >= :priceMin')
//                    ->setParameter('priceMin', $priceMin);
//        }
        if(!empty($priceMax)){
            $search->andwhere('p.price <= :priceMax')
                    ->setParameter('priceMax', $priceMax);
        }
        if(!empty($surfaceMin)){
            $search->andwhere('p.surface >= :surfaceMin')
                    ->setParameter('surfaceMin', $surfaceMin);
        }
        if(!empty($surfaceMax)){
            $search->andwhere('p.surface >= :surfaceMax')
                ->setParameter('surfaceMax', $surfaceMax);
        }
        if(!empty($handicap) && $handicap === true){
            $search->andwhere('c.name LIKE :handicap')
                ->setParameter('handicap', '%handicap%');
        }


        return $search->getQuery()->getResult();
    }


    // /**
    //  * @return Program[] Returns an array of Program objects
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
    public function findOneBySomeField($value): ?Program
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
