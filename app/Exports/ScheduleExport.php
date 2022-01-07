<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ScheduleExport implements FromCollection , WithHeadings, WithEvents
{



    protected $schedules;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
//        dd(collect($this->schedule[0]->terminal['terminal_name']));

        return collect($this->schedule);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'Terminal',
            'Service',
            'Bus Registration',
            'PickUp Location',
            'Destination',
            'Fare (Adult)',
            'Fare (Child)',
            'Departure Date',
            'Departure Time',
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
