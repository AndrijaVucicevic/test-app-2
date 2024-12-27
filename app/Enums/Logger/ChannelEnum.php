<?php

namespace App\Enums\Logger;

use App\Enums\Traits\EnumToArray;

enum ChannelEnum: string
{
    use EnumToArray;

    case USERS = 'users';
    case PERMISSIONS = 'permissions';
    case EXCEPTION = 'exeption';

    public function name(): string
    {
        return match ($this) {
            self::USERS => 'Users',
            self::PERMISSIONS => 'Permissions',
        };
    }

    /**
     * Definise podatke za logovanje
     *
     * @return array
     */
    public function log(): array
    {
        $args = func_get_args();

        return match ($this) {
            self::USERS => [
                'channel' => self::USERS->value,
                'action' => $args[0],
            ],
            self::PERMISSIONS => [
                'channel' => self::USERS->value,
                'action' => $args[0],
            ],
            self::EXCEPTION => [
                'channel' => self::EXCEPTION->value,
                'action' => $args[0],
            ],
            default => ['channel' => $this->value]
        };
    }
}
