<?php

namespace App\Imports;

use App\Models\Terminal;
use Maatwebsite\Excel\Concerns\ToModel;

class TerminalImport implements ToModel
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
        return new Terminal([
            'terminal_name'        => $row[1],
            'terminal_address'     => $row[2],
            'service_id'           => 4
        ]);
    }
}
