<?php

declare(strict_types=1);

namespace App\User\App\V1\ApiResource\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UserPostDto
{
    #[Assert\Email]
    public string $email;
}