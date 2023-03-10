<?php

namespace App\Imports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DriverImport implements ToModel
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

        return new Driver([
            'full_name' => $row[1],
            'address' => $row[2],
            'phone_number' => $row[3],
            'tenant_id' => session()->get('tenant_id'),
        ]);    
    }
}