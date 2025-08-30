<?php

namespace App\FormulaOne\Services\API;

use App\FormulaOne\Models\Track\Lap;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\LapController\FilterRequest;
use App\FormulaOne\Services\API\Enums\LapDataType;
use App\FormulaOne\Services\API\Filters\{DriverFilter, LapRangeFilter};
use App\FormulaOne\Services\API\Aggregators\{SectorsAggregator, TotalAggregator};


class LapFilterService implements LapFilter
{

    /**
     * @var Builder
     */
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
     * @return Builder
     */
    public function getQuery(FilterRequest $request): Builder
    {
        $requestParams = $request->validated();

        $this->applyAggregator(LapDataType::fromValue($requestParams['type'] ?? null));

        $appliedFilters = [
            new DriverFilter($requestParams),
            new LapRangeFilter($requestParams),
        ];

        foreach ($appliedFilters as $filter) {
            $this->query = $filter->apply($this->query);
        }

        return $this->query;
    }

    /**
     * @param LapDataType $type
     * @return void
     */
    protected function applyAggregator(LapDataType $type): void
    {
        if ($type == LapDataType::SECTORS) {
            $this->query = (new SectorsAggregator())->apply($this->query);
        } else {
            $this->query = (new TotalAggregator())->apply($this->query);
        }
    }
}
