<?php

namespace App\Utils;

use Illuminate\Support\Str;

enum MachineType: string
{
    case wash = 'Lavage';
    case dry = 'Séchage';

    public static function fromName(string $name): self {
        return match ($name) {
            'wash'=>self::wash,
            'dry'=>self::dry,
            default => 'Autre'
        };
    }

    public static function names(): array
    {
        return collect(self::cases())->map(fn($case) => $case->name)->toArray();
    }

    public static function all(): array {
        return collect(self::cases())->mapWithKeys(fn($case) => [$case->name => $case->value])->all();
    }
}
