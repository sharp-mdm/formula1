<?php

namespace App\FormulaOne\Services\API\Enums;

enum LapDataType: string
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

    /**
     * @param string|null $value
     * @param LapDataType $fallback
     * @return LapDataType
     */
    public static function fromValue(?string $value, LapDataType $fallback = self::TOTAL): LapDataType
    {
        if ($value === self::SECTORS->value) {
            return self::SECTORS;
        }

        return $fallback;
    }
}
