<?php

namespace App\FormulaOne\Services\Integrations\OpenF1\DataProvider;

use Exception;
use Throwable;
use JsonException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\{Log, Http};

class ApiDataProvider implements DataProvider
{
    /**
     * @return Collection
     */
    public function getData(): Collection
    {
        try {
            $response = Http::timeout(10)->get(config('formula_one.import_api_url'));
            if ($response->status() !== Response::HTTP_OK) {
                throw new Exception('Could not get data from API');
            }
            return collect(json_decode($response->body(), associative: true, flags: JSON_THROW_ON_ERROR));
        } catch (JsonException $e) {
            Log::error(static::class . ' invalid JSON', ['error' => $e->getMessage()]);
        } catch (Throwable $e) {
            Log::error(static::class . ' fetch error', ['error' => $e->getMessage(),]);
        }

        return collect();
    }
}
