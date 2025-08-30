<?php

namespace App\FormulaOne\Services\API\Filters;

use Illuminate\Database\Query\Builder;

class DriverFilter implements Filter
{

    /**
     * @var array|mixed
     */
    protected array $driver_ids = [];

    /**
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        if (!empty($filters['driver_ids'])) {
            $this->driver_ids = $filters['driver_ids'];
        }
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        if (!empty($this->driver_ids)) {
            $query->whereIn('laps.driver_number', $this->driver_ids);
        }

        return $query;
    }
}