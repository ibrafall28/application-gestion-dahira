<?php

namespace App\Repository;

use App\Entity\Repetition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Repetition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Repetition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Repetition[]    findAll()
 * @method Repetition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepetitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Repetition::class);
    }

    // /**
    //  * @return Repetition[] Returns an array of Repetition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Repetition
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
