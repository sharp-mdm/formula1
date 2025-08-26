<?php

namespace App\FormulaOne\Services\Integrations\OpenF1;

use DateTime;
use Illuminate\Support\Facades\Log;
use App\FormulaOne\Services\Integrations\OpenF1\Persister\Persister;
use App\FormulaOne\Services\Integrations\OpenF1\Validator\LapValidator;
use App\FormulaOne\Services\Integrations\OpenF1\DataProvider\DataProvider;

class LapImportService implements Importer
{
    protected DataProvider $provider;
    protected Persister $persister;
    protected LapValidator $validator;

    /**
     * @param DataProvider $provider
     * @param Persister $persister
     * @param LapValidator $validator
     */
    public function __construct(DataProvider $provider, Persister $persister, LapValidator $validator)
    {
        $this->provider = $provider;
        $this->persister = $persister;
        $this->validator = $validator;
    }

    /**
     * @return void
     */
    public function import(): void
    {
        Log::info('Laps data import started at ' . (new DateTime())->format('Y-m-d H:i:s.u'));

        $laps = $this->validator->validate($this->provider->getData());
        $chunkSize = config('formula_one.import_chunk_size');

        $laps->chunk($chunkSize)->each(function ($lapsChunk) {
            $existingLaps = $this->persister->getExisting($lapsChunk);  // prevent doubles

            foreach ($lapsChunk as $lapData) {
                $complexKey = $this->persister->makeComplexKey($lapData);
                if (in_array($complexKey, $existingLaps)) {
                    continue;
                }
                $this->persister->store($lapData);
            }
        });

        Log::info('Laps data import finished at ' . (new DateTime())->format('Y-m-d H:i:s.u'));
        Log::info('Processed objects count: ' . $laps->count());
    }
}
