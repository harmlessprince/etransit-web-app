<?php

namespace App\Imports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DriverImport implements ToModel, WithStartRow
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
            'full_name' => $row['full_name'],
            'address' => $row['address'],
            'phone_number' => $row['phone_number'],
            'tenant_id' => session()->get('tenant_id'),
        ]);    
    }
}