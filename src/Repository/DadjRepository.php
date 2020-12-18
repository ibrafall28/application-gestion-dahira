<?php

namespace App\Repository;

use App\Entity\Dadj;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dadj|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dadj|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dadj[]    findAll()
 * @method Dadj[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DadjRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dadj::class);
    }

    // /**
    //  * @return Dadj[] Returns an array of Dadj objects
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
    public function findOneBySomeField($value): ?Dadj
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
