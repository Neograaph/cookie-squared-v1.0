<?php

namespace App\Repository;

use App\Entity\Scraper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Scraper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scraper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scraper[]    findAll()
 * @method Scraper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScraperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scraper::class);
    }

    // /**
    //  * @return Scraper[] Returns an array of Scraper objects
    //  */
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
    public function findOneBySomeField($value): ?Scraper
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
