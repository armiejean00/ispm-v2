@props(['user'])

<tr>
    <td>{{ $user->username }}</td>

    <td class="hidden md:table-cell">{{ $user->first_name . ' ' . $user->last_name }}</td>

    <td class="hidden lg:table-cell">{{ $user->email }}</td>

    <td class="hidden md:table-cell">
        @if ($user->role === 'user')
            User
        @elseif ($user->role === 'office_manager')
            Office Manager
        @elseif ($user->role === 'admin')
            <span class="status bg-cornflowerBlue !text-black">Admin</span>
        @elseif ($user->role === 'super_admin')
            <span class="status bg-cornflowerBlue !text-black">Super Admin</span>
        @endif
    </td>

    <td>
        @if ($user->role === 'admin')
            @if (auth()->user()->role === 'super_admin')
                <a href="/users/{{ $user->id }}/edit">
                    <span class="status bg-blue-500">Edit</span>
                </a>
                {{-- <span class="status cancelled">Delete</span> --}}
                <form method="POST" action="/users/{{ $user->id }}" style="display: inline-block">
                    @csrf
                    @method('PUT')
                    @if ($user->is_approved === 0)
                        <button class="status bg-green-500">Approve</button>
                    @elseif ($user->is_approved === 1)
                        <button class="status bg-yellow-500">Put On Hold</button>
                    @endif
                </form>
            @else
                No Action.
            @endif
        @elseif ($user->role === 'super_admin')
            No Action.
        @else
            <a href="/users/{{ $user->id }}/edit">
                <span class="status bg-blue-500">Edit</span>
            </a>
            {{-- <span class="status cancelled">Delete</span> --}}
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
                <form method="POST" action="/users/{{ $user->id }}" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="status bg-red-500 !text-white">Delete</button>
                </form>
            @endif
            <form method="POST" action="/users/{{ $user->id }}" style="display: inline-block">
                @csrf
                @method('PUT')
                @if ($user->is_approved === 0)
                    <button class="status bg-green-500">Approve</button>
                @elseif ($user->is_approved === 1)
                    <button class="status bg-yellow-500">Put On Hold</button>
                @endif
            </form>
        @endif
    </td>
</tr>
