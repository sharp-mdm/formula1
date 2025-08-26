<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\FormulaOne\Services\Integrations\OpenF1\Importer;
use App\FormulaOne\Services\Integrations\OpenF1\LapImportService;
use App\FormulaOne\Services\Integrations\OpenF1\Persister\Persister;
use App\FormulaOne\Services\Integrations\OpenF1\Persister\LapPersister;
use App\FormulaOne\Services\Integrations\OpenF1\Validator\LapValidator;
use App\FormulaOne\Services\Integrations\OpenF1\DataProvider\DataProvider;
use App\FormulaOne\Services\Integrations\OpenF1\DataProvider\LapDataProvider;

class IntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            DataProvider::class,
            fn() => new LapDataProvider()
        );

        $this->app->bind(
            Persister::class,
            fn() => new LapPersister()
        );

        $this->app->bind(
            LapValidator::class,
            fn() => new LapValidator()
        );

        $this->app->bind(
            Importer::class,
            function () {
                return new LapImportService(
                    $this->app->make(DataProvider::class),
                    $this->app->make(LapPersister::class),
                    $this->app->make(LapValidator::class),
                );
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
