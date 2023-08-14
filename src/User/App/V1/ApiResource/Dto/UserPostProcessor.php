<?php

declare(strict_types=1);

namespace App\User\App\V1\ApiResource\Dto;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\User\App\V1\Message\CreateUserMessage;
use App\User\Domain\UserEmail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\MessageBusInterface;

final class UserPostProcessor implements ProcessorInterface
{
    public function __construct(private readonly MessageBusInterface $messageBus){
    }

    /**
     * @param UserPostDto $data
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $this->messageBus->dispatch(
            new CreateUserMessage(
                UserEmail::fromString($data->email)
            )
        );
    }
}