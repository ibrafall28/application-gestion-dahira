<?php

namespace App\Repository;

use App\Entity\Membre;
use App\Entity\SearchMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Membre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Membre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Membre[]    findAll()
 * @method Membre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Membre::class);
    }
    public function lasteId()
    {
        $qb = $this->createQueryBuilder('Membre');

        $qb->select('Membre')
            ->orderBy('Membre.id', 'DESC')
            ->setMaxResults( 1 );

        return $qb->getQuery()
            ->getOneOrNullResult();
        ;
    }

    public function search($tel) {
        return $this->createQueryBuilder('Membre')
            ->andWhere('Membre.telephone =:telephone')
            ->setParameter('telephone', $tel)
            ->getQuery()
            ->getOneOrNullResult();

    }
    public function findBymmbre(?SearchMembre $searchMembre=null)
    {
        $query= $this->createQueryBuilder('m')
            ->andWhere('m.etat = :val')

            ->setParameter('val', 0 )

            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10);
        if(!is_null($searchMembre)){
            if($searchMembre->getMatricule()){
                $query=$query->setParameter('mat', '%'.$searchMembre->getMatricule().'%' )
                    ->andWhere('m.matricule LIKE :mat');
            }
            if($searchMembre->getKourel()){
                $query=$query->setParameter('kourel',$searchMembre->getKourel() )
                    ->andWhere('m.kourel = :kourel');
            }
        }            return $query->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Membre[] Returns an array of Membre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Membre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
