<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create backup of database mysql';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting backup');

        $filename = 'backup-' . strtotime(now()) . '.sql';
        $storageAt = storage_path('app/backup/' . $filename);
        if(!File::exists(storage_path('app/backup'))) {
            File::makeDirectory(storage_path('app/backup'));
        }
        $command = sprintf('/Applications/MAMP/Library/bin/mysqldump -u%s -p%s %s > %s', env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'), $storageAt);
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);

        $this->info('Backup completed');
    }
}
