<?php

namespace App\Repository;

use App\Entity\Advisor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Advisor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advisor|null findOneBy(array $criteria, array $orderBy = null)
 /** @method Advisor[]    findAll()
 * @method Advisor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvisorRepository extends ServiceEntityRepository
{
    public $takeAdvisorForBoard;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advisor::class);
    }

    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }


    // /**
    //  * @return Advisor[] Returns an array of Advisor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $val  ²ue)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advisor
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function takeAdvisorForBoard(): array
    {
        $query = $this->getEntityManager()->createQuery(
            'select * 
                from advisor'
        );

        return $query->getResult();
    }
}
