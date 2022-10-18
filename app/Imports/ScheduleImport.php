<?php

namespace App\Imports;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Alert;

class ScheduleImport implements ToModel ,WithStartRow , WithBatchInserts , WithChunkReading
{
    // , WithValidation
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $bus_registration     = \App\Models\Bus::where("bus_registration", "=", $row[2])->select('id','seater','tenant_id')->first();
        $terminal_id          = \App\Models\Terminal::withoutGlobalScopes()->where("terminal_name", "=", $row[0])->select('id')->first();
        $service_id           =  \App\Models\Service::where("name", "=", $row[1])->select('id')->first();
        $pickup_id            =  \App\Models\Destination::where("location", "=", $row[3])->select('id')->first();
        $destination_id       =  \App\Models\Destination::where("location", "=", $row[4])->select('id')->first();

        $row['bus_id']          =  $bus_registration->id;
        $row['number_of_seats'] =  $bus_registration->seater;
        $row['service_id']      =  $service_id->id;
        $row['terminal_id']     =  $terminal_id->id;
        $row['pickup_id']       =  $pickup_id->id;
        $row['destination_id']  =  $destination_id->id;
        $row['tenant_id']       =  $bus_registration->tenant_id;

        $s = $row[7];
        $date = strtotime($s);
        $formattedDate = date('Y-m-d', $date);
        Log::info( $formattedDate);

       return  new Schedule([
            'terminal_id'        => $row['terminal_id'],
            'service_id'         => $row['service_id'],
            'bus_id'             => $row['bus_id'],
            'pickup_id'          => $row['pickup_id'],
            'destination_id'     => $row['destination_id'],
            'fare_adult'         => $row[5],
            'fare_children'      => $row[6],
            'departure_date'     => $formattedDate,
            'departure_time'     => $row[8],
            'tenant_id'          =>  $row['tenant_id'],
            'seats_available'    => $row['number_of_seats']
        ]);

    //    $currentSchedule = Schedule::where('bus_id', $row['bus_id'])->first();

    //     if($bus_registration->seater)
    //     {
    //         for($i = 0 ; $i < $bus_registration->seater ; $i++)
    //         {
    //           $seatTracker                = new \App\Models\SeatTracker();
    //           $seatTracker->schedule_id   = $currentSchedule->id;
    //           $seatTracker->bus_id        = (int) $bus_registration->id ;
    //           $seatTracker->seat_position = $i + 1;
    //           $seatTracker->save();
    //         }
    //     }


    //     return $schedule;
    }

    public function chunkSize(): int
    {
        return 500;
    }
    public function batchSize(): int
    {
        return 500;
    }

    // public function rules(): array
    // {
    //     return [
    //          // Can also use callback validation rules
    //          '7' => function($attribute, $value, $onFailure) {
    //               if ($value !== date('Y-m-d')) {
    //                    $onFailure('Name is not Patrick Brouwers');
    //               }
    //           }
    //     ];
    // }

}
