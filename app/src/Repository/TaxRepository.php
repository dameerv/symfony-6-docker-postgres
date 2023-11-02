<?php

namespace App\Repository;

use App\Entity\Tax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tax>
 *
 * @method Tax|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tax|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tax[]    findAll()
 * @method Tax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tax::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByCountryCode(string $countryCode): ?Tax
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.country', 'c')
            ->andWhere('c.code = :countryCode')
            ->setParameter('countryCode', $countryCode)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
