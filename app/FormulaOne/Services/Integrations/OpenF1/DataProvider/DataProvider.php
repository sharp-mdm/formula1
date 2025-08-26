<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\DataProvider;

use Illuminate\Support\Collection;

interface DataProvider
{
    public function getData(): Collection;
}
