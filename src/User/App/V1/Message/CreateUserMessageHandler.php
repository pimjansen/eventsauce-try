<?php

declare(strict_types=1);

namespace App\User\App\V1\Message;

use App\User\Domain\User;
use App\User\Domain\UserId;
use App\User\Domain\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateUserMessageHandler
{
    public function __construct(
        private UserRepository $repository,
    ) {
    }

    public function __invoke(CreateUserMessage $command): void
    {
        $user = User::create(
            UserId::generate(),
            $command->email,
        );
        $this->repository->save($user);
    }
}


