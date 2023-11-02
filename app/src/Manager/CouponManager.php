<?php

namespace App\Manager;

use App\Entity\Coupon;
use App\Repository\CouponRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CouponManager
{
    private CouponRepository|EntityRepository $taxRepository;

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        $this->taxRepository = $this->entityManager->getRepository(Coupon::class);
    }

    public function getByCode(?string $couponCode): ?Coupon
    {
        return $couponCode ?
            $this->taxRepository->findOneBy([
            'code' => $couponCode,
        ]) : null;
    }
}
