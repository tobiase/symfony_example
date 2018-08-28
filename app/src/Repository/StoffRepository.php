<?php

namespace App\Repository;

use App\Entity\Stoff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stoff|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stoff|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stoff[]    findAll()
 * @method Stoff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoffRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stoff::class);
    }

//    /**
//     * @return Stoff[] Returns an array of Stoff objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stoff
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
