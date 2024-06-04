@props(['desk'])

<tr>
    <td>{{ 'Desk ' . $desk->desk_number }}</td>
    <td>
        @php
            $amenities = json_decode($desk->amenities, true);
        @endphp
        @if (!empty($amenities))
            <ul>
                @foreach ($amenities as $amenity)
                    <li>{{ $amenity }}</li>
                @endforeach
            </ul>
        @else
            <span>No amenities</span>
        @endif
    </td>
    <td>{{ $desk->area }}</td>
    <td>
        @if ($desk->is_out_of_order === 0)
            @if ($desk->is_available === 1)
                <span class="status bg-green-500 !text-black">Available</span>
            @elseif ($desk->is_available === 0)
                <span class="status bg-orange-400 !text-black">Booked</span>
            @endif
        @elseif ($desk->is_out_of_order === 1)
            <span class="status bg-red-500 !text-black">Disabled</span>
        @endif
    </td>
    <td>
        <form method="POST" action="/desks/{{ $desk->id }}" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button class="status bg-red-500">Delete</button>
        </form>
        <form method="POST" action="/desks/{{ $desk->id }}" style="display: inline-block">
            @csrf
            @method('PUT')
            @if ($desk->is_out_of_order === 1)
                <button class="status bg-green-500">Enable</button>
            @elseif ($desk->is_out_of_order === 0)
                <button class="status bg-yellow-500">Disable</button>
            @endif
        </form>
    </td>
</tr>
