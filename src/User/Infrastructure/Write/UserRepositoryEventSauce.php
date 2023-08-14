<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Write;

use App\User\Domain\User;
use App\User\Domain\UserId;
use App\User\Domain\UserRepository;
use EventSauce\EventSourcing\AggregateRootRepository;

class UserRepositoryEventSauce implements UserRepository
{
    public function __construct(private AggregateRootRepository $repository)
    {
    }

    public function save(User $user): void
    {
        $this->repository->persist($user);
    }

    public function get(string $id): User
    {
        return $this->repository->retrieve(UserId::fromString($id));
    }
}
