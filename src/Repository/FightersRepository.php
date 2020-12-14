<?php

namespace App\Repository;

use App\Entity\Fighters;
use App\NewClass\Recherche;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Fighters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fighters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fighters[]    findAll()
 * @method Fighters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FightersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fighters::class);
        
    }

    /**
     * @requete pour recup les fighters
     * @return Fighters[]
     */
    public function findWithRecherche(Recherche $recherche){
        $query = $this
        ->createQueryBuilder('f');


        if(!empty($recherche->string)){
            $query = $query
            ->andWhere('f.name LIKE :string')
            ->setParameter('string',"%{$recherche->string}%");
        }
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Fighters[] Returns an array of Fighters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fighters
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
