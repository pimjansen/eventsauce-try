<?php

declare(strict_types=1);

namespace App\User\App\V1\Message\Projector;

use App\User\Domain\Event\UserWasCreated;
use Doctrine\DBAL\Connection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserWasCreatedProjectorMessageHandler
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    public function __invoke(UserWasCreated $event): void
    {
        $this->connection->insert('`user`', [
            'user_id' => Uuid::fromString($event->id->toString())->getBytes(),
            'email' => $event->email,
        ]);
    }
}


