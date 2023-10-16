<?php

namespace App\EventSubscriber;

use App\Dto\PriceRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ControllerArgumentsValidationSubscriber implements EventSubscriberInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        foreach ($event->getArguments() as $argument) {
            if ($argument instanceof PriceRequest) {
                $violations = $this->validator->validate($argument);

                if (count($violations)) {
                    $jsonResponse = new JsonResponse([
                        'success' => false,
                        'messages' => $this->createMessages($violations)
                    ]);

                    $jsonResponse->send();
                }
            }
        }
    }

    private function createMessages(ConstraintViolationList $violations): array
    {
        $messages = [];

        foreach ($violations as $violation) {
            $messages[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $messages;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => 'onKernelControllerArguments',
        ];
    }
}
