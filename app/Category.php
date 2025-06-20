<?php

namespace App;

enum Category
{
    case Academic;
    case Entertainment;
    case Sports;

    public function label(): string
    {
        return match ($this) {
            self::Academic => 'Academic',
            self::Entertainment => 'Entertainment',
            self::Sports => 'Sports',
        };
    }
}
