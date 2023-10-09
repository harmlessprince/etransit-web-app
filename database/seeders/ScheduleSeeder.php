<?php

namespace Database\Seeders;

use App\Imports\DataImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new DataImport, storage_path('app/data.xlsx'));
        //$collection = Excel::toCollection(new DataImport, 'app/data.xlsx');
    }
}

class ScheduleData
{

    public $operator;
    public $terminal;
    public $number_plate;
    public $pickup;
    public $seats;
    public $destination;
    public $adult_price;
    public $child_price;
    public $departure_date;
    public $departure_time;
    public $return_trip;
    public $return_date;
    public $return_time;
    public $terminal_address;
    public $operator_address;
    public $operator_phone;
    public $bus_model;
    public $bus_type;


}
