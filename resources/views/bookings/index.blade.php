<x-layout :cssPaths="$cssPaths" :title="$title">
    <section id="sidebar" class="hide">
        <span class="brand opacity-0">

        </span>
        <ul class="side-menu top">
            <li>

            </li>
            <li>
                <a href="/dashboard">
                    <?php if (auth()->user()->role == 'user'): ?>
                    <i class='bx bxs-home bx-sm'></i>
                    <span class="text">Home</span>
                    <?php else: ?>
                    <i class='bx bxs-dashboard bx-sm'></i>
                    <span class="text">Dashboard</span>
                    <?php endif; ?>
                </a>
            </li>
            @unless (auth()->user()->role == 'user')
                <li class="active">
                    <a href="/bookings">
                        <i class='bx bxs-book-alt bx-sm'></i>
                        <span class="text">Booking</span>
                    </a>
                </li>
            @endunless
            <li>
                <a href="/office_map">
                    <i class='bx bxs-map bx-sm'></i>
                    <span class="text">Office Map</span>
                </a>
            </li>
            @unless (auth()->user()->role !== 'admin' && auth()->user()->role !== 'super_admin')
                <li>
                    <a href="/users">
                        <i class='bx bxs-group bx-sm'></i>
                        <span class="text">Manage Users</span>
                    </a>
                </li>
            @endunless

            <li>
                <a href="/desks/available">
                    <i class='bx bx-desktop bx-sm'></i>
                    <span class="text">Manage Desks</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <li>
                <a href="/faqs">
                    <i class='bx bx-question-mark bx-sm'></i>
                    <span class="text">FAQs</span>
                </a>
            </li>
            <li>
                <a href="/guide">
                    <i class='bx bxs-component bx-sm'></i>
                    <span class="text">User Guide</span>
                </a>
            </li>
            <li>
                <a href="/feedback">
                    <i class='bx bxs-message '></i>
                    <span class="text">Feedback</span>
                </a>
            </li>
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="logout">
                        <i class='bx bxs-log-out-circle bx-sm'></i>
                        <span class="text">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav style="background-color:#dfe1e69c">
            <i class='bx bx-menu bx-sm'></i>
            <h1 class="font-bold text-md text-congressBlue lg:text-xl flex">
                <img class="inline-block h-7 pb-2 lg:h-9 lg:pb-3" src="{{ asset('images/ahs-ape.svg') }}"
                    alt="A">pexHubSpot
            </h1>

            <form action="#">
                <div class="form-input">

                </div>
            </form>

            {{-- <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> --}}
            @auth
                <a href="/profile" class="profile"
                    style="background-color:black;padding:5px 20px;color:white;border-radius:10px;border:1px solid black;">
                    <div style="display:flex;">
                        @unless (auth()->user()->role == 'user' || auth()->user()->role == 'office_manager' || auth()->user()->role == 'super_admin')
                            <img src="{{ asset('images/admin.jpg') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless

                        @unless (auth()->user()->role == 'admin' ||
                                auth()->user()->role == 'office_manager' ||
                                auth()->user()->role == 'super_admin')
                            <img src="{{ asset('images/dummy.png') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless

                        @unless (auth()->user()->role == 'admin' || auth()->user()->role == 'user' || auth()->user()->role == 'super_admin')
                            <img src="{{ asset('images/manager.jpg') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless
                        @unless (auth()->user()->role == 'admin' || auth()->user()->role == 'user' || auth()->user()->role == 'office_manager')
                            <img src="{{ asset('images/super_admin.png') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless
                        {{ auth()->user()->username }}
                    </div>

                </a>
            @else
                <a href="/profile" class="profile font-bold">Profile</a>
            @endauth
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <p style="font-size:30px; display: inline-block;">Bookings</p>
                    <form action="{{ route('bookings.toggleAutoAccept') }}" method="POST" style="display:inline;">
                        @csrf
                        <label for="auto_accept" style="margin-left: 20px;">
                            Auto Accept:
                            <input type="hidden" name="auto_accept" value="0">
                            <input type="checkbox" id="auto_accept" name="auto_accept" value="1"
                                {{ $auto_accept == '1' ? 'checked' : '' }} onchange="this.form.submit()">
                        </label>
                    </form>
                </div>
            </div>

            <div class="table-data">
                <div class="order" style="background-color:#dfe1e69c">
                    {{ $bookings->links() }}
                    <div class="head">
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Desk Number</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($bookings as $booking)
                                @php
                                    $today = Carbon\Carbon::now()->toDateString();
                                    $book_date = \App\Models\AvailableDesk::find($booking->available_desk_id)->date;
                                    $status =
                                        $auto_accept == '1'
                                            ? ($today == $book_date
                                                ? 'Ongoing'
                                                : 'Accepted')
                                            : ($booking->status == 'pending'
                                                ? 'Pending'
                                                : ($today == $book_date
                                                    ? 'Ongoing'
                                                    : 'Accepted'));
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/' . \App\Models\User::find($booking->user_id)->profile_image) }}"
                                            alt="Profile Image" style="height:40px;width:40px;border-radius:20px;">
                                        {{ \App\Models\User::find($booking->user_id)->first_name . ' ' . \App\Models\User::find($booking->user_id)->last_name }}
                                    </td>
                                    <td>
                                        Desk {{ \App\Models\Desk::find($booking->desk_id)->desk_number }}
                                    </td>
                                    <td>
                                        {{ $book_date }}
                                    </td>
                                    <td>
                                        <span
                                            class="status {{ $status == 'Ongoing' ? 'bg-orange-400' : ($status == 'Accepted' ? 'bg-emerald-400' : 'bg-yellow-400') }} !text-black">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display:flex">
                                            @if ($auto_accept != '1' && $booking->status == 'pending')
                                                <form action="{{ route('bookings.accept', $booking->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="status bg-emerald-400 !text-white">Accept</button>
                                                </form>
                                            @endif
                                            @if (auth()->user()->role != 'user')
                                                <form method="post" action="/bookings/{{ $booking->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="status bg-dangerRed !text-white">Cancel</button>
                                                </form>
                                            @endif
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="{{ asset('js/booking.js') }}"></script>
    <script src="{{ asset('javascript/homepage.js') }}"></script>
</x-layout>
