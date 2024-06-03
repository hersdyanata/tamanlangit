<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coupons;
use Carbon\Carbon;

class setExpiredCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-expired-coupons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set expire coupons status if current date exceeds end date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $coupons = Coupons::where('status', 'A')->where('end_date', '<', Carbon::now())->get();
        foreach($coupons as $coupon){
            $coupon->status = 'E';
            $coupon->save();
        }

        $this->info('Coupon statuses updated successfully');
    }
}
