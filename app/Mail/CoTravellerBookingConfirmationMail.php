<?php

namespace App\Mail;

use App\Models\Bus;
use App\Models\Driver;
use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoTravellerBookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Driver $driver;
    public Transaction $transaction;
    public Schedule $schedule;
    public Bus $bus;
    public User $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user = null,Driver $driver = null, Transaction $transaction = null, Schedule $schedule = null, Bus $bus = null)
    {
        $this->user = $user;
        $this->driver = $driver;
        $this->transaction = $transaction;
        $this->schedule = $schedule;
        $this->bus = $bus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.co-traveller-booking');
    }
}
