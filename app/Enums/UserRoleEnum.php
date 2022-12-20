<?php
declare(strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRoleEnum extends Enum
{
    public const ADMIN = 0;
    public const USER = 1;

    public static function getArrayView()
    {
        return [
            'Admin' => self::ADMIN,
            'User'  => self::USER,
        ];
    }

    public static function getRoleByValue($value)
    {
        return array_search($value, self::getArrayView(), true);
    }
}
