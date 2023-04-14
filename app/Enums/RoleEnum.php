<?php

namespace App\Enums;

enum RoleEnum: string
{
    case USER = 'user';
    case ADMIN = 'admin';

    public static function getRole(RoleEnum $role): string
    {
        return match ($role) {
            self::ADMIN => 'admin',
            self::USER => 'user',

            default => $role->value,
        };
    }
}
