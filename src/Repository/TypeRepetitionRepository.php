<?php

namespace App\Repository;

use App\Entity\TypeRepetition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeRepetition|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRepetition|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRepetition[]    findAll()
 * @method TypeRepetition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepetitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRepetition::class);
    }

    // /**
    //  * @return TypeRepetition[] Returns an array of TypeRepetition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeRepetition
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
