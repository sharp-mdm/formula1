<?php

namespace App\FormulaOne\Services\API\Filters;

use Closure;
use Illuminate\Database\Query\Builder;

interface Filter
{

    /**
     * @param array $filters
     */
    public function __construct(array $filters);

    /**
     * @param $query
     * @param Closure $next
     * @return Builder
     */
    public function handle($query, Closure $next): Builder;

}