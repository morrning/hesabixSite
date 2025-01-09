<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use App\Entity\Cat;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    //    /**
    //     * @return Post[] Returns an array of Post objects
    //     */
    //    public function findPageByUrl($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findByUrlFilterCat($value,$cat='plain'): ?Post
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.cat', 'c')
            ->where('c.code = :cat')
            ->andWhere('p.url = :url')
            ->setParameter('url', $value)
            ->setParameter('cat', $cat)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findBycat($cat='blog' , $count = 3): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.cat', 'c')
            ->where('c.code = :cat')
            ->setParameter('cat', $cat)
            ->setMaxResults($count)
            ->orderBy('p.dateSubmit','DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
