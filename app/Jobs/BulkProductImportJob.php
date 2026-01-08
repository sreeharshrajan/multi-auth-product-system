<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BulkProductImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;

    /**
     * Create a new job instance.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            Excel::import(
                new ProductImport,
                Storage::path($this->filePath)
            );
        } catch (\Throwable $e) {
            Log::error('Bulk product import failed', [
                'file' => $this->filePath,
                'error' => $e->getMessage(),
            ]);
            //Retry
            throw $e;
        }
    }
}
