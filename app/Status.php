<?php

namespace App;

enum Status
{
    case Draft;
    case Published;

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
        };
    }
}
