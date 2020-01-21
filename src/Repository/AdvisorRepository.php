<?php

namespace App\Repository;

use App\Entity\Advisor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Advisor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advisor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advisor[]    findAll()
 * @method Advisor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvisorRepository extends ServiceEntityRepository
{
    public $takeAdvisorForBoard;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advisor::class);
    }



    public function takeAdvisorForBoard(): array
    {
        $query = $this->getEntityManager()->createQuery(
            'select * 
                from advisor'
        );

        return $query->getResult();
    }
}
