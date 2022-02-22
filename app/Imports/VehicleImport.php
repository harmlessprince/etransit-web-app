<?php

namespace App\Imports;

use App\Models\Bus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VehicleImport implements ToModel ,WithStartRow
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

        $tenant = \App\Models\Tenant::where("company_name", "=", $row[7])->select('id')->first();
        $row['tenant_id']  = $tenant->id;

        return new Bus([
            'bus_type'             => $row[1],
            'bus_model'            => $row[2],
            'bus_registration'     => $row[3],
            'air_conditioning'     => $row[4],
            'wheels'               => $row[5],
            'seater'               => $row[6],
            'tenant_id'            => $row['tenant_id'],
            'service_id'           => 1,
        ]);
    }
}
