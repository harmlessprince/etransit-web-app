<?php

namespace App\Jobs;

use App\Notifications\PasswordResetNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;


class SendPasswordResetEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    private $user;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
     public $tries = 5;
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
     public $timeout = 20;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data , $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user, new PasswordResetNotification($this->data));
    }
}
