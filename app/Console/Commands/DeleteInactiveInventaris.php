<?php

namespace App\Console\Commands;

use App\Models\Inventaris;
use Illuminate\Console\Command;

class DeleteInactiveInventaris extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventaris:delete-inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus data inventaris dengan is_active = 0';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deletedCount = Inventaris::where('is_active', 0)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->whereNotNull('updated_at')
                        ->where('updated_at', '<', now()->subMonths(3));
                })
                    ->orWhere(function ($q) {
                        $q->whereNull('updated_at')
                            ->where('created_at', '<', now()->subMonths(3));
                    });
            })
            ->delete();

        $this->info("Berhasil menghapus {$deletedCount} inventaris tidak aktif yang sudah lebih dari 3 bulan.");

        return Command::SUCCESS;
    }
}
