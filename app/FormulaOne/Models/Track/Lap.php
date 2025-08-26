<?php

namespace App\FormulaOne\Models\Track;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lap extends Model
{

    public const MAX_SECTORS_NUMBER = 3;

    public $fillable = [
        'driver_number',
        'lap_number',
    ];

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function lapSectors(): HasMany
    {
        return $this->hasMany(LapSector::class);
    }
}
