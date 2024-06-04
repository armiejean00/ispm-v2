<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Logs</title>
</head>
<body>
    <h1>Booking Logs</h1>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Email</th>
                <th>Desk</th>
                <th>Date</th>
                <th>IP Address</th>
                <th>Booked At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->user->username }}</td>
                    <td>{{ $log->user_role }}</td>
                    <td>{{ $log->user_email }}</td>
                    <td>Desk {{ $log->desk->desk_number }}</td>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>