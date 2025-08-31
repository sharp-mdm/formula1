<?php

namespace App\FormulaOne\Services\API\Filters;

use Illuminate\Database\Query\Builder;

class LapRangeFilter implements Filter
{

    /**
     * @var int|mixed|null
     */
    protected int|null $lap_from = null;

    /**
     * @var int|mixed|null
     */
    protected int|null $lap_to = null;

    /**
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        if (isset($filters['lap_from'])) {
            $this->lap_from = $filters['lap_from'];
        }
        if (isset($filters['lap_to'])) {
            $this->lap_to = $filters['lap_to'];
        }
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder
    {
        if ($this->lap_from !== null && $this->lap_to !== null) {
            $query->whereBetween(
                'lap_number',
                [
                    $this->lap_from,
                    $this->lap_to
                ]
            );
        }

        return $query;
    }
}
