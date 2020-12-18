<?php

namespace App\Repository;

use App\Entity\Caisse;
use App\Entity\Filtre;
use App\Entity\Hadiya;
use App\Entity\Membre;
use App\Entity\SearchMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Hadiya|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hadiya|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hadiya[]    findAll()
 * @method Hadiya[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HadiyaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hadiya::class);
    }
    public function sommeByMembre(Membre $membre)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.membre = :membre')
            ->setParameter('membre', $membre)
            ->select('SUM(h.montant) as sommnt')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function findByhadiya(?Filtre $filtre)
    {
        $query= $this->createQueryBuilder('h')
            ->andWhere('h.id > : val')

            ->setParameter('val', 0 )

            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10);
        if(!is_null($filtre)){
            if($filtre->getDate()->format("Y-m-d")){
                $query=$query->setParameter('dt', '%'.$filtre->getDate()->format("Y-d-m").'%' )
                    ->andWhere('h.date LIKE :dt');
            }

        }            return $query->getQuery()
        ->getResult()
        ;
    }

    public function search(Caisse $caisse) {
        return $this->createQueryBuilder('h')
            ->andWhere('h.ciasse =:ciasse')
            ->setParameter('ciasse', $caisse)
            ->getQuery()
            ->getOneOrNullResult();

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
    //  * @return Hadiya[] Returns an array of Hadiya objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /*
    public function findOneBySomeField($value): ?Hadiya
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
