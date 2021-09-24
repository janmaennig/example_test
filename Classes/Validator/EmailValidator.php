<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Validator;

use Assert\Assertion;

class EmailValidator
{
    public static function isValid(string $email): bool
    {
        Assertion::email($email);

        return true;
    }
}
