<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class ImportUsers extends Command
{
    protected $signature = 'import:users {file=users.xlsx}';
    protected $description = 'Import users from an Excel file';

    public function handle()
{
    $file = storage_path("app/{$this->argument('file')}");

    if (!file_exists($file)) {
        $this->error("File {$file} tidak ditemukan.");
        return 1;
    }

    $this->info("Importing users from {$file}...");

    try {
        Excel::import(new \App\Imports\UsersImport, $file);
        $this->info("✅ Import selesai!");
    } catch (\Exception $e) {
        $this->error("❌ Gagal import: " . $e->getMessage());
        return 1;
    }

    return 0;
}

}
