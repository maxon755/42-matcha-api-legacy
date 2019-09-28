<?php

namespace App\Validators;

use App\Interfaces\ValidatorInterface;

class PasswordValidator implements ValidatorInterface
{
    private static $regexps = [
        [
            'regexp' =>'/[A-Z]/',
            'message' => "Password must have at least one uppercase letter",
        ],
        [
            'regexp' =>'/[a-z]/',
            'message' =>"Password must have at least one lowercase letter"
        ],
        [
            'regexp' => '/[0-9]/',
            'message' =>"Password must have at least one digit"
        ],
        [
            'regexp' => '/[!@#$%^&*()_=+]/',
            'message' => "Password must have at least one spec symbol !@#$%^&*()_=+",

        ],
    ];

    public static function validate($value, array $payload = []): bool
    {
        foreach (self::$regexps as $item) {
            if (!preg_match($item['regexp'], $value)) {
                return false;
            }
        }

       return true;
    }

    public static function getErrorMessage(
        $value,
        string $columnName,
        array $payload = []
    ): string
    {
        foreach (self::$regexps as $item) {
            if (!preg_match($item['regexp'], $value)) {
                return $item['message'];
            }
        }

        return "";
    }
}
