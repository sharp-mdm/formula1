<?php

namespace App\Http\Resources\Api\Lap;

use Illuminate\Contracts\Support\Responsable;

class LapTotalCollection implements Responsable
{
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $this->collection = $this->collection->groupBy('lap_number')->map(function ($lapGroup) {
            return $lapGroup->pluck('lap_time', 'driver_number');
        });


        return response()->json($this->collection);
    }
}