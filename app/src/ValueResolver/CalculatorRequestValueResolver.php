<?php

namespace App\ValueResolver;

use App\Dto\PriceRequestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

readonly class CalculatorRequestValueResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        $argumentType = $argument->getType();

        if (!$argumentType || !is_subclass_of($argumentType, PriceRequestInterface::class)) {
            return [];
        }

        $content = $request->getContent();

        return [
            $this->serializer->deserialize($content, $argumentType, 'json', [
                AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false,
            ])
        ];
    }
}