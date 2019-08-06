<?php

namespace App\Repository;

use App\Entity\PdfFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PdfFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method PdfFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method PdfFile[]    findAll()
 * @method PdfFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PdfFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PdfFile::class);
    }

    // /**
    //  * @return PdfFile[] Returns an array of PdfFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PdfFile
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
