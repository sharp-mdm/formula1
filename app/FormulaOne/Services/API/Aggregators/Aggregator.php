<?php

namespace App\FormulaOne\Services\API\Aggregators;

use Illuminate\Database\Query\Builder;

interface Aggregator
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function apply(Builder $query): Builder;

}
