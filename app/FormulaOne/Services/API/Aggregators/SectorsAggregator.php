<?php

namespace App\FormulaOne\Services\API\Aggregators;

use Illuminate\Database\Query\Builder;

class SectorsAggregator implements Aggregator
{

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        return $query->select(
            'laps.lap_number',
            'laps.driver_number',
            'lap_sectors.sector_number',
            'lap_sectors.duration',
        );
    }
}