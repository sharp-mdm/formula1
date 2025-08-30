<?php

namespace App\Http\Controllers\Api\V1;

use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Responsable;
use App\FormulaOne\Services\API\LapFilterService;
use App\Http\Requests\LapController\FilterRequest;
use App\FormulaOne\Services\API\Enums\LapDataType;
use App\FormulaOne\Services\API\Response\LapResponseFactory;

class LapController extends Controller
{

    /**
     * @OA\Get(
     *  path="/api/v1/laps",
     *  tags={"Laps"},
     *  summary="Get filtered laps data",
     *  description="",
     *  @OA\Parameter(
     *   name="type",
     *   description="Grouping by lap or sectors. The value 'total' is default behavior",
     *   in="query",
     *   required=false,
     *   @OA\Schema( type="enum", enum={"total", "sectors"} ),
     *  ),
     *  @OA\Parameter(
     *   name="driver_ids[]",
     *   description="Filter by driver IDs",
     *   in="query",
     *   required=false,
     *   @OA\Schema(
     *    type="array",
     *     @OA\Items( type="integer" )
     *    ),
     *  ),
     *  @OA\Parameter(
     *   name="lap_from",
     *   description="Set laps between range 'from' part",
     *   in="query",
     *   required=false,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\Parameter(
     *   name="lap_to",
     *   description="Set laps between range 'to' part",
     *   in="query",
     *   required=false,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\Response(response=200, description="Successful operation"),
     *  @OA\Response(response=422, description="Validation errors"),
     * )
     */
    public function index(FilterRequest $request, LapFilterService $lapFilterService): Responsable
    {
        return LapResponseFactory::create(
            $lapFilterService->getQuery($request)->get(),
            LapDataType::fromValue($request->get('type'))
        );
    }
}
