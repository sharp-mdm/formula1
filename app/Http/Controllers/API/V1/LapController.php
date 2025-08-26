<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use App\FormulaOne\Services\API\LapFilterService;
use App\Http\Requests\LapController\FilterRequest;
use App\FormulaOne\Services\API\Enums\LapDataTypes;
use App\Http\Resources\Api\Lap\LapTotalCollection;
use App\Http\Resources\Api\Lap\LapSectorsCollection;


class LapController extends Controller
{
    /**
     * @param FilterRequest $request
     * @param LapFilterService $lapFilterService
     * @return Responsable
     */
    public function index(FilterRequest $request, LapFilterService $lapFilterService): Responsable
    {
        $filteredLaps = $lapFilterService->getFilteredData($request);

        if ($request->get('type') == LapDataTypes::SECTORS->value) {
            return new LapSectorsCollection($filteredLaps);
        }
        return new LapTotalCollection($filteredLaps);
    }
}
