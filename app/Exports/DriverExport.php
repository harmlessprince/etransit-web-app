<?php

namespace App\Exports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class DriverExport implements FromCollection , WithHeadings, WithEvents
{



    protected $drivers;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($drivers)
    {
        $this->driver = $drivers;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
//        dd(collect($this->schedule[0]->terminal['terminal_name']));

        return collect($this->driver);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'Full Name',
            'Address',
            'Phone Number',
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
