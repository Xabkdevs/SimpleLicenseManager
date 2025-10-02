<?php

namespace App\Console\Commands;

use App\Models\License;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateLicenseKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:generate {count : Number of license keys to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate bulk license keys and insert into database with inactive status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');
        
        if ($count <= 0) {
            $this->error('Count must be a positive integer.');
            return 1;
        }

        $this->info("Generating {$count} license keys...");

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        $generatedKeys = [];
        $batchSize = 100; // Process in batches to avoid memory issues

        for ($i = 0; $i < $count; $i += $batchSize) {
            $currentBatchSize = min($batchSize, $count - $i);
            $batch = [];

            for ($j = 0; $j < $currentBatchSize; $j++) {
                $licenseKey = $this->generateUniqueLicenseKey();
                $batch[] = [
                    'license_key' => $licenseKey,
                    'first_name' => 'Generated',
                    'last_name' => 'License',
                    'brand_name' => 'System Generated',
                    'phone' => '000-000-0000',
                    'os' => 'Unknown',
                    'status' => 'inactive',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $generatedKeys[] = $licenseKey;
                $bar->advance();
            }

            // Insert batch into database
            License::insert($batch);
        }

        $bar->finish();
        $this->newLine();

        $this->info("Successfully generated {$count} license keys!");
        $this->info("All keys have been saved to the database with 'inactive' status.");

        // Show first few generated keys as examples
        if (count($generatedKeys) > 0) {
            $this->newLine();
            $this->info("Sample generated keys:");
            $sampleKeys = array_slice($generatedKeys, 0, min(5, count($generatedKeys)));
            foreach ($sampleKeys as $key) {
                $this->line("  - {$key}");
            }
            if (count($generatedKeys) > 5) {
                $this->line("  ... and " . (count($generatedKeys) - 5) . " more");
            }
        }

        return 0;
    }

    /**
     * Generate a unique license key
     */
    private function generateUniqueLicenseKey(): string
    {
        do {
            // Generate a license key with format: SAHEL-XXXX-XXXX-XXXX-XXXX
            $key = 'SAHEL-' . strtoupper(Str::random(4)) . '-' . 
                   strtoupper(Str::random(4)) . '-' . 
                   strtoupper(Str::random(4)) . '-' . 
                   strtoupper(Str::random(4));
        } while (License::where('license_key', $key)->exists());

        return $key;
    }
}
