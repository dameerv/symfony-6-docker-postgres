<?php

namespace App\Request\Converter;

use App\Controller\PriceController;
use App\Controller\PurchaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class RequestConverterProvider implements ServiceSubscriberInterface
{
    public function __construct(
        private readonly ContainerInterface $locator,
    ) {
    }

    /**
     * @return RequestConverterInterface[]
     */
    public static function getSubscribedServices(): array
    {
        return [
            PriceController::class => PriceRequestConverter::class,
            PurchaseController::class => PurchaseRequestConverter::class
        ];
    }

    /**
     * @throws \Exception
     */
    public function get(AbstractController $controller): RequestConverterInterface
    {
        $controllerClass = get_class($controller);

        if ($this->locator->has($controllerClass)) {
            /** @var RequestConverterInterface $converter */
            $converter = $this->locator->get($controllerClass);

            return $converter;
        }

        throw new \Exception("RequestConverter not found");
    }

    public function has(AbstractController $controller): bool
    {
        try {
            $this->get($controller);

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
