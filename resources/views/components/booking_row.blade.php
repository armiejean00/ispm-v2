@props(['booking'])

<tr>
    @php
        $today = Carbon\Carbon::now()->toDateString();
        $book_date = \App\Models\AvailableDesk::find($booking->available_desk_id)->date;
    @endphp
    <td>
        {{ \App\Models\User::find($booking->user_id)->first_name . ' ' . \App\Models\User::find($booking->user_id)->last_name }}
    </td>
    <td>
        Desk {{ \App\Models\Desk::find($booking->desk_id)->desk_number }}
    </td>
    <td>
        {{ $book_date }}
    </td>
    <td>
        @if ($today == $book_date)
            <span class="status bg-orange-400 !text-black">On Going</span>
        @elseif (\App\Models\Desk::find($booking->desk_id)->is_out_of_order == 1)
            <span class="status bg-red-400 !text-black">Canceled</span>
        @else
            <span class="status bg-emerald-400 !text-black">Accepted</span>
        @endif
    </td>
    <td>
        @if (auth()->user()->role != 'user')
            <form method="post" action="/bookings/{{ $booking->id }}">
                @csrf
                @method('DELETE')
                <button class="status bg-dangerRed !text-white">Cancel</button>
            </form>
        @endif
    </td>
</tr>
