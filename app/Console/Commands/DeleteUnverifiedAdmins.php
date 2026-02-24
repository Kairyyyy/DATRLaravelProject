<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DeleteUnverifiedAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admins:delete-unverified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unverified admin accounts older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffTime = Carbon::now()->subHours(24);
        
        $deleted = Admin::whereNull('email_verified_at')
            ->where('created_at', '<=', $cutoffTime)
            ->delete();

        $this->info("Deleted {$deleted} unverified admin accounts.");
        
        return Command::SUCCESS;
    }
}