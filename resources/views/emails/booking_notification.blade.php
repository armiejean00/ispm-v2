<!DOCTYPE html>
<html>

<head>
    <title>Booking Reminder</title>
</head>

<body>
    <h1>Booking Reminder</h1>
    <p>Dear {{ $user->username }},</p>
    <p>This is a reminder that you have a booking scheduled for Desk {{ $booking->desk_id }} on {{ $booking->date }}.
    </p>
    <p>If you no longer wish to receive these notifications, you can disable them in your profile settings.</p>
    <p>Thank you.</p>
</body>

</html>
