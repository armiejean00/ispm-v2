<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\User;
use App\Mail\BookingNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendBookingNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;
    protected $user;

    public function __construct(Booking $booking, User $user)
    {
        $this->booking = $booking;
        $this->user = $user;
    }

    public function handle(Mailer $mailer)
    {
        $mailer->to($this->user->email)->send(new BookingNotificationMail($this->booking, $this->user));
    }
}