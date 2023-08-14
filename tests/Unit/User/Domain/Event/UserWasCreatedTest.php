<?php

use App\Tests\Unit\User\Domain\Event\UserBase;
use function EventSauce\EventSourcing\PestTooling\expectToFail;
use function EventSauce\EventSourcing\PestTooling\given;
use function EventSauce\EventSourcing\PestTooling\nothingShouldHaveHappened;
use function EventSauce\EventSourcing\PestTooling\when;

uses(UserBase::class);

it('creates an user succesfully', function () {
    when(function (CreateUserCommand $command): void {
        $command->create();
    })->then(

    )
    expectToFail(SorryCantCheckout::becauseThereAreNoProductsInCart());
    nothingShouldHaveHappened();
});

it('or mix it all', function () {
    given(new ShoppingCartInitiated())
        ->when(function (ShoppingCart $cart): void {
            $cart->checkout();
        });
    expectToFail(SorryCantCheckout::becauseThereAreNoProductsInCart())
        ->nothingShouldHaveHappened();
});

it('can be used in a compact manner')
    ->given(new ShoppingCartInitiated())
    ->when(fn (ShoppingCart $cart) => $cart->add(new ProductId('garlic sauce'), 250))
    ->then(new ProductAddedToCart(new ProductId('garlic sauce'), 250))
    ->assertScenario(); // needed for a Pest bug
//use App\User\Domain\Event\UserWasCreated;
//use App\User\Domain\UserEmail;
//
//
//namespace Senet\Communication\Sms\Domain\Events;
//
//use Senet\Communication\Sms\App\V1\Command\SendSmsCommand;
//use Senet\Communication\Sms\Domain\SmsFrom;
//use Senet\Communication\Sms\Domain\SmsNumber;
//
//class SendSmsTest extends AbstractSms
//{
//    public function testSendSmsSuccesful(): void
//    {
//        $smsId = $this->newAggregateRootId();
//        $from = SmsFrom::fromString('ME');
//        $to = SmsNumber::fromString('+31612345677');
//        $body = 'Hi there';
//
//        $this->when(
//            new SendSmsCommand(
//                $smsId,
//                $from,
//                $to,
//                $body,
//            )
//        )->then(
//            new SmsWasCreated(
//                $smsId,
//                $from,
//                $to,
//                $body,
//            ),
//            new SmsWasSent(
//                $smsId,
//                new \DateTimeImmutable('2023-01-01 10:10:10'),
//            )
//        );
//    }
//}
