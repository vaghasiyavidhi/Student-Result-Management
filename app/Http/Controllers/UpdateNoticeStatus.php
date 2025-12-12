<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateNoticeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notices:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set notice status to Inactive if the expiry date has passed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        // Find active notices where the expiry date is in the past
        $expiredNoticesCount = Notice::where('status', 'Active')
                                     ->where('expiry_date', '<', $today)
                                     ->update(['status' => 'Inactive']);

        if ($expiredNoticesCount > 0) {
            $message = $expiredNoticesCount . ' expired notices have been marked as Inactive.';
            $this->info($message);
            Log::info($message);
        } else {
            $this->info('No expired notices found to update.');
        }

        return Command::SUCCESS;
    }
}
