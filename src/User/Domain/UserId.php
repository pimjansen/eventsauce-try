<?php

namespace App\User\Domain;

use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;

final class UserId implements AggregateRootId, \Stringable
{
    private function __construct(private readonly string $id)
    {
    }

    public static function generate(): AggregateRootId
    {
        return new static(Uuid::uuid4()->toString());
    }

    public static function fromString(string $aggregateRootId): static
    {
        if (Uuid::isValid($aggregateRootId) === false) {
            throw new \InvalidArgumentException('Invalid UUID provided');
        }
        return new static($aggregateRootId);
    }

    public function toString(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
