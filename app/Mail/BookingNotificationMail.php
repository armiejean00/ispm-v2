<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use App\Models\User;

class BookingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $user;

    public function __construct(Booking $booking, User $user)
    {
        $this->booking = $booking;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Booking Reminder')->view('emails.booking_notification');
    }
}