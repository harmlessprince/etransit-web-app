<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class FerryBookings extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;

        $customPaper = array(0,0,567.00,283.80);
        $pdf = PDF::loadView('pdf.ferry-booking', compact('data'))->setPaper($customPaper, 'landscape');;

        return $this->markdown('emails.ferrybookings')
                            ->subject('Etransit Feery Booking Ticket')
                            ->with('data', $this->data)
                            ->attachData($pdf->output(), "receipt.pdf");
    }
}
