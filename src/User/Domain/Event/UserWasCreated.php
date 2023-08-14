<?php

declare(strict_types=1);

namespace App\User\Domain\Event;

use App\User\Domain\UserEmail;
use App\User\Domain\UserId;
use EventSauce\Clock\Clock;
use EventSauce\Clock\SystemClock;
use EventSauce\EventSourcing\Serialization\SerializablePayload;

final readonly class UserWasCreated implements SerializablePayload
{
    public function __construct(
        public UserId $id,
        public UserEmail $email,
        public Clock $now,
    ) {
    }

    /**
     * @param array<string, string> $payload
     */
    public static function fromPayload(array $payload): static
    {
        return new static(
            UserId::fromString($payload['id']),
            UserEmail::fromString($payload['email']),
        );
    }

    /**
     * @return array<string, string>
     */
    public function toPayload(): array
    {
        return [
            'id' => (string) $this->id,
            'email' => (string) $this->email,
        ];
    }
}
