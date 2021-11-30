<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StartCarHireTrip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car-hire:start-trip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to start a  car hire trip';

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

            $carbookinss = \App\Models\CarHistory::where('date', now()->format('Y-m-d'))
                ->where('time' ,'<=', now()->format('H:i'))
                ->get();


            foreach($carbookinss as $index =>  $booking)
            {
                $booking->update(['available_status' => 'On Trip' ]);
                $car = \App\Models\Car::where('id' ,$carbookinss[$index]->car_id)->first();
                $car->update(['booked_status'=>'true']);

            }
        DB::commit();
        $this->info('Booking status changed to unbooked successfully');
    }
}
