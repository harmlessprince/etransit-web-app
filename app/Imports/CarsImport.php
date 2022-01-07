<?php

namespace App\Imports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CarsImport implements ToModel ,WithStartRow
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
        return new Car([
            'car_type'          => $row[1],
            'car_class'         => $row[2],
            'daily_rentals'     => $row[3],
            'extra_hour'        => $row[4],
            'sw_fare'           => $row[5],
            'ss_fare'           => $row[6],
            'se_fare'           => $row[7],
            'nc_fare'           => $row[8],
            'description'       => $row[9],
            'capacity'          => $row[10],
        ]);
    }
}
