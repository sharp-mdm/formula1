<?php

namespace App\FormulaOne\Services\API\Filters;

use Closure;
use Illuminate\Database\Query\Builder;

class DriverFilter implements Filter
{

    protected array $filters;

    /**
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @param $query
     * @param Closure $next
     * @return Builder
     */
    public function handle($query, Closure $next): Builder
    {
        if (isset($this->filters['driver_id'])) {
            $query->whereIn('laps.driver_number', $this->filters['driver_id']);
        }

        return $next($query);
    }
}