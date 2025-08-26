<?php

namespace App\FormulaOne\Services\API\Enums;

enum LapDataTypes: string
{
    case TOTAL = 'total';
    case SECTORS = 'sectors';

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
