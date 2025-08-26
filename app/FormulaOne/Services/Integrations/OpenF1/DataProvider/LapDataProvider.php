<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\DataProvider;

use Throwable;
use JsonException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class LapDataProvider implements DataProvider
{
    public function getData(): Collection
    {
        try {
            $response = Http::timeout(10)->get(config('formula_one.import_api_url'));
            return collect(json_decode($response->body(), associative: true, flags: JSON_THROW_ON_ERROR));
        } catch (JsonException $e) {
            Log::error(static::class . ' invalid JSON', ['error' => $e->getMessage()]);
        } catch (Throwable $e) {
            Log::error(static::class . ' fetch error', ['error' => $e->getMessage(),]);
        }

        return collect();
    }
}
