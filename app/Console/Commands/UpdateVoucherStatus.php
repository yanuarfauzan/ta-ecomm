<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateVoucherStatus extends Command
{
    protected $signature = 'voucher:update-status';
    protected $description = 'Update status vouchers to expired if past expired_at';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Voucher::where('expired_at', '<', Carbon::now())
            ->where('is_active', 1)
            ->update(['is_active' => 0]);

        $this->info('Voucher status updated successfully.');
    }
}
