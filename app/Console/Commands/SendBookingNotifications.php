<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\BookingNotificationMail;

class SendBookingNotifications extends Command
{
    protected $signature = 'send:booking-notifications';

    protected $description = 'Send email notifications for bookings that are today or tomorrow';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $tomorrow = Carbon::now()->addDay()->toDateString();

        $bookings = Booking::whereIn('date', [$today, $tomorrow])->get();

        foreach ($bookings as $booking) {
            $user = User::find($booking->user_id);
            if ($user->booking_notifications) {
                Mail::to($user->email)->send(new BookingNotificationMail($booking, $user));
                Log::info("Booking notification sent to user: {$user->email} for booking date: {$booking->date}");
            } else {
                Log::info("User: {$user->email} has disabled booking notifications.");
            }
        }

        $this->info('Booking notifications sent successfully.');
    }
}
