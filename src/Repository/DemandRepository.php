<?php

namespace App\Repository;

use App\Entity\Demand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Demand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demand[]    findAll()
 * @method Demand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demand::class);
    }

    public function findByOneStatus($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.status = :val')
            ->setParameter('val', $value)
            ->orderBy('d.deadline', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByTwoStatus($value1, $value2)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.status = :val1', 'd.status = :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->orderBy('d.deadline', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Demand[] Returns an array of Demand objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Demand
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
