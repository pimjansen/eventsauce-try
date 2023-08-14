<?php

use App\User\Domain\UserId;
use Ramsey\Uuid\Uuid;

it('ensures it generates valid uuids', function() {
    $instance = UserId::generate();
    expect(Uuid::isValid((string)$instance))->toBeTrue();
})->repeat(5);

it('throws exception on invalid data', function(string $value) {
    UserId::fromString($value);
})->with(['no-valid-uuid'])
    ->throws(InvalidArgumentException::class);

it('can be casted to string', function(string $value) {
    $instance = UserId::fromString($value);
    expect((string) $instance)->toBe($value);
})->with(['2cd66610-0c57-4b57-974b-dd26c8075527']);