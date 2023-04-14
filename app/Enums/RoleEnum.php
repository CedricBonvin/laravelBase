<?php

namespace App\Enums;

enum RoleEnum: string
{
    case USER = 'user';
    case VIP = 'vip';
    case MODERATOR = 'moderator';
    case ADMIN = 'admin';

    public static function getRole(RoleEnum $role): string
    {
        return match ($role) {
            self::ADMIN => 'admin',
            self::MODERATOR => 'moderator',
            self::VIP => 'vip',
            self::USER => 'user',

            default => $role->value,
        };
    }
}
