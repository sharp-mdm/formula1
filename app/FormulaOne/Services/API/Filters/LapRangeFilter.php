<?php

namespace App\FormulaOne\Services\API\Filters;

use Closure;
use Illuminate\Database\Query\Builder;

class LapRangeFilter
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
        if (isset($this->filters['lap_from']) && isset($this->filters['lap_to'])) {
            $query->whereBetween(
                'lap_number',
                [
                    $this->filters['lap_from'],
                    $this->filters['lap_to']]
            );
        }

        return $next($query);
    }
}
