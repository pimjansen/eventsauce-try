<?php

declare(strict_types=1);

namespace App\User\App\V1\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\User\App\V1\ApiResource\Dto\UserPostDto;
use App\User\App\V1\ApiResource\Dto\UserPostProcessor;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Post(
            input: UserPostDto::class,
            processor: UserPostProcessor::class
        ),
        new Delete(),
    ],
    routePrefix: '/v1',
)]
class User
{
    #[ApiProperty(identifier: true)]
    public int $id;

    #[Assert\Length(
        min: 3,
        max: 255,
    )]
    public ?string $firstname;

    #[Assert\Length(
        min: 3,
        max: 255,
    )]
    public ?string $lastname;

    #[Assert\Email]
    public string $email;
}
