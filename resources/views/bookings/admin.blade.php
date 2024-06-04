@extends('layouts.app')

@section('content')
    <h1>Pending Bookings</h1>
    @foreach ($bookings as $booking)
        <div>
            <p>User: {{ $booking->user->name }}</p>
            <p>Date: {{ $booking->date }}</p>
            <p>Desk: {{ $booking->desk->name }}</p>
            <form action="{{ route('bookings.accept', $booking->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Accept</button>
            </form>
            {{-- <form action="{{ route('bookings.reject', $booking->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Reject</button>
            </form> --}}
        </div>
    @endforeach
@endsection
