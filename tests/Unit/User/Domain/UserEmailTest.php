<?php

use App\User\Domain\UserEmail;

it('ensures only valid emails are used', function(string $email) {
    $instance = UserEmail::fromString($email);
    expect($instance)->toBeInstanceOf(UserEmail::class);
})->with(['valid@email.com', 'foo@bar.nl']);

it('throws exception on invalid data', function(string $email) {
    UserEmail::fromString($email);
})->with(['foo@bar@bar.nl', 'foobar'])
    ->throws(InvalidArgumentException::class);
it('can be casted to string', function() {
    $instance = UserEmail::fromString('foo@bar.nl');
    expect((string) $instance)->toBe('foo@bar.nl');
});