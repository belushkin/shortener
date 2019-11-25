<?php

namespace App\Repository;

use App\Entity\Url;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Url|null find($id, $lockMode = null, $lockVersion = null)
 * @method Url|null findOneBy(array $criteria, array $orderBy = null)
 * @method Url[]    findAll()
 * @method Url[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Url::class);
    }

    public function findUrlsWithCount(User $user = null)
    {
        $query = $this->createQueryBuilder('url');

        $query
            ->addSelect('COUNT(meta.id) as cnt')
            ->leftJoin('url.metas', 'meta')
            ->orderBy('url.id', 'DESC')
            ->groupBy('url.id');

        if ($user) {
            $query->where('url.user = :val')
            ->setParameter('val', $user);
        } else {
            $query->where('url.user IS NULL');
        }

        return $query
            ->getQuery()
            ->getResult();
    }

}
