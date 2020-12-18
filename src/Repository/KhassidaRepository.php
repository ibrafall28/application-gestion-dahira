<?php

namespace App\Repository;

use App\Entity\Khassida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Khassida|null find($id, $lockMode = null, $lockVersion = null)
 * @method Khassida|null findOneBy(array $criteria, array $orderBy = null)
 * @method Khassida[]    findAll()
 * @method Khassida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KhassidaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Khassida::class);
    }

    // /**
    //  * @return Khassida[] Returns an array of Khassida objects
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
    public function findOneBySomeField($value): ?Khassida
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
