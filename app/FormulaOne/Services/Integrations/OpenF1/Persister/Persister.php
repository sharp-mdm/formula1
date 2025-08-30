<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\Persister;

use Illuminate\Support\Collection;

interface Persister
{
    /**
     * @param Collection $laps
     * @return array
     */
    public function getExisting(Collection $laps): array;

    /**
     * @param array $lapData
     * @return void
     */
    public function store(array $lapData): void;

    /**
     * @param array $lap
     * @return string
     */
    public function makeComplexKey(array $lap): string;
}
