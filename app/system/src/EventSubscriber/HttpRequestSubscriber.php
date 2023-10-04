<?php

namespace App\EventSubscriber;

use App\Request\Converter\RequestConverterProvider;
use App\Request\PriceRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HttpRequestSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly RequestConverterProvider $requestConverterProvider
    ) {
    }

    /**
     * @throws \Exception
     */
    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $httpRequest = $event->getRequest();
        $controller = $event->getController()[0];
        if (!$this->requestConverterProvider->has($controller)) {
            return;
        }

        $requestData = json_decode($httpRequest->getContent(), true);
        $request = $this->requestConverterProvider
            ->get($controller)
            ->convertFromArray($requestData);

        $violations = $this->validator->validate($request);

        if (count($violations) > 0) {
            $this->sendErrorResponse((string)$violations);
        }

        $event->setArguments([$request]);
    }

    private function sendErrorResponse($messages): void
    {
        $response = $this->json([
            'errors' => $messages,
        ], 400);

        $response->send();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => 'onKernelControllerArguments',
        ];
    }

    public function json(array $data, int $status, array $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }
}
