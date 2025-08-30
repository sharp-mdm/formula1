<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\Persister;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\FormulaOne\Models\Track\Lap;
use App\FormulaOne\Models\Track\LapSector;

class LapPersister implements Persister
{

    /**
     * @param Collection $laps
     * @return array
     */
    public function getExisting(Collection $laps): array
    {
        $idPairs = $laps->map(fn($lap) => $this->makeComplexKey($lap));

        return Lap::whereIn(
            DB::raw("CONCAT(driver_number, '-', lap_number)"),
            $idPairs
        )->get()->map(fn($lap) => $lap->driver_number . '-' . $lap->lap_number)->toArray();
    }

    /**
     * @param array $lapData
     * @return void
     * @throws Throwable
     */
    public function store(array $lapData): void
    {
        try {
            DB::beginTransaction();
            $lap = Lap::create([
                'driver_number' => $lapData['driver_number'],
                'lap_number'    => $lapData['lap_number'],
            ]);

            $sectors = [];
            for ($i = 1; $i <= Lap::MAX_SECTORS_NUMBER; $i++) {
                $sectors[] = [
                    'lap_id'        => $lap->id,
                    'sector_number' => $i,
                    'duration'      => $lapData['duration_sector_' . $i],
                ];
            }
            LapSector::insert($sectors);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error(static::class . ' saving error', ['error' => $e->getMessage()]);
        }
    }

    /**
     * @param array $lap
     * @return string
     */
    public function makeComplexKey(array $lap): string
    {
        return $lap['driver_number'] . '-' . $lap['lap_number'];
    }
}
