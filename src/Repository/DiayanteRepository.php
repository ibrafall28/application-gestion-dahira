<?php

namespace App\Repository;

use App\Entity\Diayante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Diayante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diayante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diayante[]    findAll()
 * @method Diayante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiayanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diayante::class);
    }
    public function findById($val) {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :val')
            ->setParameter('val', $val)
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();

        ;

    }

    // /**
    //  * @return Diayante[] Returns an array of Diayante objects
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
    public function findOneBySomeField($value): ?Diayante
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
