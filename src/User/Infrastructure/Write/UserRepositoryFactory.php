<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Write;

use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\Read\UserConsumer;
use Doctrine\DBAL\Connection;
use EventSauce\EventSourcing\EventSourcedAggregateRootRepository;
use EventSauce\EventSourcing\Serialization\ConstructingMessageSerializer;
use EventSauce\EventSourcing\SynchronousMessageDispatcher;
use EventSauce\MessageRepository\DoctrineMessageRepository\DoctrineMessageRepository;

class UserRepositoryFactory
{
    public function __construct(
        private readonly Connection $connection
    ){}

    public function create(): UserRepository
    {
        return new UserRepositoryEventSauce(
            new EventSourcedAggregateRootRepository(
                User::class,
                new DoctrineMessageRepository(
                    $this->connection,
                    'eventstore',
                    new ConstructingMessageSerializer(),
                ),
                new SynchronousMessageDispatcher(
                    new UserConsumer($this->connection)
                ),
            ),
        );
    }
}
