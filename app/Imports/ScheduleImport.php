<?php

namespace App\Imports;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ScheduleImport implements ToModel ,WithStartRow
{

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

        $bus_registration = \App\Models\Bus::where("bus_registration", "=", $row[2])->select('id','seater','tenant_id')->first();
        $terminal_id      = \App\Models\Terminal::withoutGlobalScopes()->where("terminal_name", "=", $row[0])->select('id')->first();
        $service_id        =  \App\Models\Service::where("name", "=", $row[1])->select('id')->first();
        $pickup_id       =  \App\Models\Destination::where("location", "=", $row[3])->select('id')->first();
        $destination_id       =  \App\Models\Destination::where("location", "=", $row[4])->select('id')->first();


        $row['bus_id']          = $bus_registration->id;
        $row['number_of_seats'] = $bus_registration->seater;
        $row['service_id']      = $service_id->id;
        $row['terminal_id']     =  $terminal_id->id;
        $row['pickup_id']       =  $pickup_id->id;
        $row['destination_id']  = $destination_id->id;
        $row['tenant_id'] = $bus_registration->tenant_id;

        $s = $row[7];
        $date = strtotime($s);
        $formattedDate = date('Y-m-d H:i:s', $date);
        Log::info( $formattedDate);

        return new Schedule([
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
    }
}
