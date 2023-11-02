<?php

namespace App\Manager;

use App\Entity\Tax;
use App\Repository\TaxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class TaxManager
{
    private TaxRepository|EntityRepository $taxRepository;

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        $this->taxRepository = $this->entityManager->getRepository(Tax::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getTaxByCountryCode(string $countryCode): ?Tax
    {
        return $this->taxRepository->findByCountryCode($countryCode);
    }
}
