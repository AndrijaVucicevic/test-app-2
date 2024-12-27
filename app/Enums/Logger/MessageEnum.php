<?php

namespace App\Enums\Logger;

enum MessageEnum: string
{

    case EXCEPTION = 'GRESKA <> %s';


    public function message(): string
    {
        $args = func_get_args();

        return match ($this) {
            self::EXCEPTION  => sprintf($this->value, $args[0]),
            default => $this->value
        };
    }
}
