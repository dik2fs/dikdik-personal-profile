<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class BackupProfileData extends Command
{
    protected $signature = 'profile:backup';
    protected $description = 'Backup semua data profile ke file JSON';

    public function handle()
    {
        $backupData = [
            'timestamp' => now()->toISOString(),
            'profile' => Profile::first(),
            'projects' => Project::all(),
            'contacts' => Contact::all(),
        ];

        $filename = 'profile-backup-' . now()->format('Y-m-d-H-i-s') . '.json';
        Storage::disk('local')->put('backups/' . $filename, json_encode($backupData, JSON_PRETTY_PRINT));

        $this->info('Backup berhasil dibuat: ' . $filename);
        return Command::SUCCESS;
    }
}