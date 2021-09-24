<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Tests\Unit\Validator;

use Assert\InvalidArgumentException;
use JanMaennig\ExampleTests\Validator\EmailValidator;
use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{
    /**
     * @dataProvider validEmailProvider
     */
    public function testValidEmails(string $email): void
    {
        $this->assertTrue(EmailValidator::isValid($email));
    }

    /**
     * @dataProvider invalidEmailProvider
     */
    public function testInvalidEmails(string $email, string $message): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        EmailValidator::isValid($email);
    }

    public function validEmailProvider(): array
    {
        return [
            [
                'email' => 'jma@move-elevator.de',
            ],
            [
                'email' => 'jan.maennig@test.de',
            ],
            [
                'email' => 'j-maennig@test.de',
            ],
        ];
    }

    public function invalidEmailProvider(): array
    {
        return [
            [
                'message' => 'Value "jma@move-elevator" does not match expression.',
                'email' => 'jma@move-elevator',
            ],
            [
                'email' => 'jan@maennig@test.de',
                'message' => 'Value "jan@maennig@test.de" was expected to be a valid e-mail address.',
            ],
            [
                'email' => 'invalid_mail',
                'message' => 'Value "invalid_mail" was expected to be a valid e-mail address.',
            ],
        ];
    }
}
