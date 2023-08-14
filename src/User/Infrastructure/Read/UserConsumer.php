<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Read;

use App\User\App\V1\Message\Projector\UserWasCreatedProjectorMessage;
use App\User\Domain\Event\UserWasCreated;
use EventSauce\EventSourcing\EventConsumption\EventConsumer;
use Symfony\Component\Messenger\MessageBusInterface;

class UserConsumer extends EventConsumer
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {}

    public function handleUserWasCreated(UserWasCreated $event): void
    {
        $this->dispatch(new UserWasCreatedProjectorMessage($event));
    }
}