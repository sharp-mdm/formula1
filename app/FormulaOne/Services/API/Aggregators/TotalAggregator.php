<?php

namespace App\FormulaOne\Services\API\Aggregators;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class TotalAggregator implements Aggregator
{

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        $query->select(
            'laps.lap_number',
            'laps.driver_number',
            DB::raw('SUM(lap_sectors.duration) as lap_time')
        );

        return $query->groupBy('laps.lap_number', 'laps.driver_number');
    }
}
