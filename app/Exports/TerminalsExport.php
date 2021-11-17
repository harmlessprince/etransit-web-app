<?php

namespace App\Exports;

use App\Models\Terminal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;

class TerminalsExport implements FromCollection
{
    protected $data;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }




    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'id',
            'terminal_name',
            'terminal_address'
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');

                $event->sheet->getDelegate()->freezePane('A2');
            },

        ];
    }

}
