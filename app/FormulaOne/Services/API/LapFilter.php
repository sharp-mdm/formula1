<?php

namespace App\FormulaOne\Services\API;

use Illuminate\Database\Query\Builder;
use App\Http\Requests\LapController\FilterRequest;

interface LapFilter
{

    /**
     * @param FilterRequest $request
     * @return Builder
     */
    public function getQuery(FilterRequest $request): Builder;
}
