<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\DataProvider;

use Illuminate\Support\Collection;

interface DataProvider
{
    /**
     * @return Collection
     */
    public function getData(): Collection;
}
