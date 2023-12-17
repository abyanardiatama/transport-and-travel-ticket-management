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

        $filename = 'backup-' . Carbon::now()->translatedFormat('dmY-His') . '.sql';
        $storageAt = storage_path('app/backup/' . $filename);
        if(!File::exists(storage_path('app/backup'))) {
            File::makeDirectory(storage_path('app/backup'));
        }
        $command = sprintf(
            'mysqldump -u%s -p%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            $storageAt
        );
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);

        $this->info('Backup completed');
    }
}
