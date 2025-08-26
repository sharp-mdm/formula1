<?php

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;
use App\FormulaOne\Services\Integrations\OpenF1\Importer;
use Illuminate\Support\Facades\Log;

class ImportLaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-laps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import laps data from open F1 API';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            app(Importer::class)->import();
        } catch (Throwable $e) {
            $errorMessage = '"' . $this->signature . '" command error: ' . $e->getMessage();
            Log::error($errorMessage);
            $this->error($errorMessage);
            return Command::FAILURE;
        }
        $this->info('Laps statistics data imported successfully. See logs for more detailed output');
        return Command::SUCCESS;
    }
}
