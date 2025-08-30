<?php

namespace App\FormulaOne\Services\API\Response;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\FormulaOne\Services\API\Enums\LapDataType;
use App\Http\Resources\Api\Lap\{LapTotalCollection, LapSectorsCollection};

class LapResponseFactory
{

    /**
     * @param Collection $filteredLaps
     * @param LapDataType $type
     * @return Responsable
     */
    public static function create(Collection $filteredLaps, LapDataType $type): Responsable
    {
        return match ($type) {
            LapDataType::TOTAL => new LapTotalCollection($filteredLaps),
            LapDataType::SECTORS => new LapSectorsCollection($filteredLaps),
        };
    }
}
