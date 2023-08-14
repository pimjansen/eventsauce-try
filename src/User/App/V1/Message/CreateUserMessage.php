<?php

declare(strict_types=1);

namespace App\User\App\V1\Message;

use App\User\Domain\UserEmail;

class CreateUserMessage
{
    public function __construct(
        public UserEmail $email,
    ) {
    }
}
