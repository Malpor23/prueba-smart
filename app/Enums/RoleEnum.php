<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public function getText(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::USER => 'Usuario',
        };
    }

    public static function getList(): array
    {
        $list = [];
        foreach (self::cases() as $case)
        {
            $list[$case->value] = $case->getText();
        }
        return $list;
    }
}
