<?php

namespace App\FormulaOne\Models\Track;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LapSector extends Model
{
    public $timestamps = false;

    public $casts = [
        'duration' => 'string'
    ];

    /**
     * @return BelongsTo
     */
    public function lap(): belongsTo
    {
        return $this->belongsTo(Lap::class);
    }
}
