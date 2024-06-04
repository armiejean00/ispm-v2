<!DOCTYPE html>
<html>

<head>
    <title>New Hot Desking Issue Report</title>
</head>

<body>
    <h1>New Hot Desking Issue Report</h1>
    <p><strong>Issue:</strong> {{ $issue }}</p>
    <p><strong>Details:</strong> {{ $details }}</p>
    <p><strong>Reported by:</strong> {{ $username }} ({{ $role }})</p>
    @if ($photoPath)
        <p><strong>Attached photo:</strong> Yes</p>
    @else
        <p><strong>Attached photo:</strong> No</p>
    @endif
</body>

</html>
