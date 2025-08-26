<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\Persister;

use Illuminate\Support\Collection;

interface Persister
{
    public function getExisting(Collection $laps): array;

    public function store(array $lapData): void;

    public function makeComplexKey(array $lap): string;
}
