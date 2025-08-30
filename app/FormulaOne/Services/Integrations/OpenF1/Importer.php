<?php

namespace App\FormulaOne\Services\Integrations\OpenF1;

interface Importer
{
    /**
     * @return void
     */
    public function import(): void;
}
