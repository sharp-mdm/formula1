<?php

namespace App\FormulaOne\Services\API\Filters;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\FormulaOne\Services\API\Enums\LapDataTypes;

class TypeFilter implements Filter
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
        if (isset($this->filters['type']) && $this->filters['type'] == LapDataTypes::SECTORS->value) {
            $query->select(
                'laps.lap_number',
                'laps.driver_number',
                'lap_sectors.sector_number',
                'lap_sectors.duration',
            );
        } else {
            $query->select(
                'laps.lap_number',
                'laps.driver_number',
                DB::raw('SUM(lap_sectors.duration) as lap_time')
            );
            $query->groupBy('laps.lap_number', 'laps.driver_number');
        }

        return $next($query);
    }
}
