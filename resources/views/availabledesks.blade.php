<x-layout :cssPaths="$cssPaths" :title="$title">

    <!-- SIDEBAR -->
    <section id="sidebar" class="hide">
        <span class="brand opacity-0">
            <img src="{{ asset('images/main/logo.png') }}" alt="" style="width:60px">
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
                <li>
                    <a href="/bookings">
                        <i class='bx bxs-book-alt bx-sm'></i>
                        <span class="text">Booking</span>
                    </a>
                </li>
            @endunless
            <li class="active">
                <a href="/office_map">
                    <i class='bx bxs-map bx-sm'></i>
                    <span class="text">Office Map</span>
                </a>
            </li>
            @unless (auth()->user()->role == 'user' || auth()->user()->role == 'office_manager')
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
                    <p style="font-size:30px">Desks Availability</p>
                </div>
            </div>

            <div class="table-data">
                <div class="order" style="background-color:#dfe1e69c">
                    <div>
                        {{ $desks->links() }}
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Desk</th>
                                <th>Image</th>
                                <th>Amenities</th>
                                <th>Area</th>
                                <th>Current Status</th>

                            </tr>
                        </thead>
                        <tbody>

                            @unless ($desks->isEmpty())
                                @foreach ($desks as $desk)
                                    <tr>
                                        <td>{{ 'Desk ' . $desk->desk_number }}</td>
                                        <td>

                                            <img src="{{ asset('images/desks/' . $desk->desk_number . '.png') }}"
                                                alt=""
                                                style="width:50px;height:50px; border-radius:0px;object-fit:cover"
                                                id="desk_image">
                                        </td>
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
                                                    <span class="status bg-emerald-400 !text-black">Available</span>
                                                @elseif ($desk->is_available === 0)
                                                    <span class="status bg-orange-400 !text-black">Booked</span>
                                                @endif
                                            @elseif ($desk->is_out_of_order === 1)
                                                <span class="status bg-red-400 !text-black">Disabled</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No desks found.</td>
                                </tr>
                            @endunless
                        </tbody>
                    </table>
                    <div>
                        {{ $desks->links() }}
                    </div>
                </div>
            </div>
        </main>
    </section>
</x-layout>
