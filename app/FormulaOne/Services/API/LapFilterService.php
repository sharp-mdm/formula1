<?php

namespace App\FormulaOne\Services\API;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use App\FormulaOne\Models\Track\Lap;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\LapController\FilterRequest;
use App\FormulaOne\Services\API\Filters\TypeFilter;
use App\FormulaOne\Services\API\Filters\DriverFilter;
use App\FormulaOne\Services\API\Filters\LapRangeFilter;

class LapFilterService implements LapFilter
{
    protected array $filters = [];

    protected Builder $query;

    public function __construct()
    {
        $this->query = Lap::query()
            ->leftJoin('lap_sectors', 'laps.id', '=', 'lap_sectors.lap_id')
            ->orderBy('laps.lap_number')
            ->getQuery();
    }

    /**
     * @param FilterRequest $request
     * @return Collection
     */
    public function getFilteredData(FilterRequest $request): Collection
    {
        $this->filters = $request->validated();

        $this->query = app(Pipeline::class)
            ->send($this->query)
            ->through([
                fn($query, $next) => (new TypeFilter($this->filters))->handle($query, $next),
                fn($query, $next) => (new DriverFilter($this->filters))->handle($query, $next),
                fn($query, $next) => (new LapRangeFilter($this->filters))->handle($query, $next),
            ])
            ->thenReturn();

        return $this->query->get();
    }
}
