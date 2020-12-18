<?php

namespace App\Repository;

use App\Entity\Kourel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kourel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kourel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kourel[]    findAll()
 * @method Kourel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KourelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kourel::class);
    }

    // /**
    //  * @return Kourel[] Returns an array of Kourel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kourel
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
