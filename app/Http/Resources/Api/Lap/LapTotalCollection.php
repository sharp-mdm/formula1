<?php

namespace App\Http\Resources\Api\Lap;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;

class LapTotalCollection implements Responsable
{

    protected Collection $collection;

    /**
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $this->collection = $this->collection->groupBy('lap_number')->map(function ($lapGroup) {
            return $lapGroup->pluck('lap_time', 'driver_number');
        });

        return response()->json($this->collection);
    }
}
