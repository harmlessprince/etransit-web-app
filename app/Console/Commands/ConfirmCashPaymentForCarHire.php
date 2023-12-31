<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use DateTime;

class ConfirmCashPaymentForCarHire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car-hire:cash-payment-confirmation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that checks every cash payment confirmation for car hire every 30minutes , if the payment has not been confirmed  , update the status in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        DB::beginTransaction();

        $transactions = \App\Models\Transaction::where('service_id',6)->get();

        if(!is_null($transactions))
        {
            foreach ($transactions as $transaction)
            {

                $tarnsactiontime = new DateTime($transaction->created_at);
                $currentTime = new DateTime(now());
                $difference =  $tarnsactiontime->diff($currentTime);
                $diffInMinutes = $difference->i;

                if($diffInMinutes >= 30)
                {
                    if($transaction->status = 'Pending')
                    {
                        $transaction->carhistory->update([
                            'payment_status' => 'Pending',
                            'isConfirmed'   => 'False'
                            //                        'available_status' =>
                        ]);
                        $this->info($transaction->carhistory);
                    }
                }

            }

        DB::commit();
        $this->info('worked');
        }


    }
}
