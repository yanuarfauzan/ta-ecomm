<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Voucher;

class UpdateExpiredVouchers extends Command
{
    protected $signature = 'voucher:update-expired';

    protected $description = 'Update status of expired vouchers';

    public function handle()
    {
        $expiredVouchers = Voucher::where('expired_at', '<=', now())->get();
        
        foreach ($expiredVouchers as $voucher) {
            $voucher->update(['is_active' => false]);
        }

        $this->info('Expired vouchers updated successfully.');
    }
}
