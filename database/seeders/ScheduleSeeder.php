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


