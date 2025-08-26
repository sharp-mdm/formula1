<?php

namespace App\FormulaOne\Services\API;

use Illuminate\Support\Collection;
use App\Http\Requests\LapController\FilterRequest;

interface LapFilter
{
    /**
     * @param FilterRequest $request
     * @return Collection
     */
    public function getFilteredData(FilterRequest $request): Collection;
}
