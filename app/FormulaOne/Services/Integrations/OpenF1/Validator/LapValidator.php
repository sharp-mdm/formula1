<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\Validator;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\FormulaOne\Models\Track\Lap;
use Illuminate\Support\Facades\Validator;

class LapValidator
{

    /**
     * @param Collection $laps
     * @return Collection
     */
    public function validate(Collection $laps): Collection
    {
        $rules = [
            'driver_number' => ['required', 'integer'],
            'lap_number'    => ['required', 'integer'],
        ];

        for ($i = 1; $i <= Lap::MAX_SECTORS_NUMBER; $i++) {
            $rules['duration_sector_' . $i] = ['present', 'nullable', 'numeric'];
        }

        return $laps->filter(function ($lapData) use ($rules) {
            $validator = Validator::make($lapData, $rules);

            if ($validator->fails()) {
                Log::error('Invalid lap data:', [
                    'data'   => $lapData,
                    'errors' => $validator->errors()->toArray(),
                ]);
                return false;
            }
            return true;
        })->values();
    }
}
