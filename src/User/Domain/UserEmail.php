<?php

declare(strict_types=1);

namespace App\User\Domain;

use Webmozart\Assert\Assert;

final class UserEmail implements \Stringable
{
    private function __construct(readonly private string $email)
    {
    }

    public static function fromString(string $email): static
    {
        Assert::email($email);
        return new static($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
