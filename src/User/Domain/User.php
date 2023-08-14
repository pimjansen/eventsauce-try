<?php

declare(strict_types=1);

namespace App\User\Domain;

use App\User\Domain\Event\UserWasCreated;
use DateTimeZone;
use EventSauce\Clock\SystemClock;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class User implements AggregateRoot
{
    use AggregateRootBehaviour;

    private ?UserEmail $email = null;

    public static function create(UserId $id, UserEmail $email): self
    {
        $user = new static($id);

        $clock = new SystemClock(new DateTimeZone('Europe/Amsterdam'));
        $user->recordThat(
            new UserWasCreated(
                $user->aggregateRootId,
                $email,
                $clock->now(),
            )
        );

        return $user;
    }

    public function applyUserWasCreated(UserWasCreated $event): void
    {
        $this->email = $event->email;
    }

    public function email(): ?UserEmail
    {
        return $this->email;
    }
}
