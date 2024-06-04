<x-layout :cssPaths="$cssPaths" :title="$title">



    <!-- SIDEBAR -->
    <section id="sidebar" class="hide">
        <span class="brand opacity-0"></span>
        {{-- <button id="darkModeToggle" class="toggle-dark-mode"> --}}
        <ul class="side-menu top">

            <li>

            </li>
            <li class="active">
                <a href="/dashboard">
                    @if (auth()->user()->role == 'user')
                        <i class='bx bxs-home bx-sm'></i>
                        <span class="text">Home</span>
                    @else
                        <i class='bx bxs-dashboard bx-sm'></i>
                        <span class="text">Dashboard</span>
                    @endif
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
                    @if (auth()->user()->role == 'user')
                        <i class='bx bxs-book bx-sm'></i>
                        <span class="text">Booking</span>
                    @else
                        <i class='bx bx-desktop bx-sm'></i>
                        <span class="text">Manage Desks</span>
                    @endif
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
                    <i class='bx bxs-message'></i>
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
                <div class="form-input"></div>
            </form>


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

            <div class="table-data">
                <div class="order" style="background-color:#dfe1e69c">
                    <div class="head">
                        <p style="font-size:30px">Welcome, {{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}! You may book your desk.</p><br>
                        <a href="/desks/available"
                            style="background-color:darkblue;color:white;font-size:30px;padding:10px;border-radius:10px">Book
                            now</a>
                    </div>
                </div>
            </div>
            @unless (auth()->user()->role == 'user')
                <p style="font-size:30px">Dashboard</p>

                <div class="table-data">
                    <div class="order" style="background-color:#dfe1e69c">
                        <div class="head">
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
                            <div style="display:flex;height:400px;width:500px">
                                <canvas id="barChart" width="400" height="400" style="margin-right:70px;"></canvas>
                                <canvas id="pieChart" width="400" height="400" style="margin-left:70px;"></canvas>
                            </div>
                            <script>
                                var available = {{ $available }};
                                var totalDesks = {{ $totalDesks }};
                                var disabled = {{ $disabled }};

                                var ctxBar = document.getElementById('barChart').getContext('2d');
                                var barChart = new Chart(ctxBar, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Available Desks', 'Total Desks', 'Disabled Desks'],
                                        datasets: [{
                                            label: ' ',
                                            data: [available, totalDesks, disabled],
                                            backgroundColor: ['rgba(54, 162, 235, 0.6)',
                                                'rgba(255, 99, 132, 0.6)',
                                                'rgba(255, 206, 86, 0.6)',
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(255, 206, 86, 1)',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

                                var ctxPie = document.getElementById('pieChart').getContext('2d');
                                var pieChart = new Chart(ctxPie, {
                                    type: 'pie',
                                    data: {
                                        labels: ['Available Desks', 'Disabled Desks'],
                                        datasets: [{
                                            data: [available, disabled],
                                            backgroundColor: [
                                                'rgba(54, 162, 235, 0.6)',

                                                'rgba(255, 206, 86, 0.6)',
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)',

                                                'rgba(255, 206, 86, 1)',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    plugins: [ChartDataLabels],
                                    options: {
                                        plugins: {
                                            datalabels: {
                                                formatter: (value, context) => {
                                                    let sum = 0;
                                                    let dataArr = context.chart.data.datasets[0].data;
                                                    dataArr.map(data => {
                                                        sum += data;
                                                    });
                                                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                                                    return percentage;
                                                },
                                                color: '#fff',
                                                font: {
                                                    weight: 'bold'
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>


                        <ul class="box-info">

                            <li style="background-color:#dfe1e69c">
                                <i class='bx bxs-calendar-check'></i>
                                <span class="text">
                                    <h3>{{ $totalBookings }}</h3>
                                    <p>Booked Desks</p>
                                </span>
                            </li>
                            <li style="background-color:#dfe1e69c">
                                <i class='bx bx-table' style="background-color:rgba(54, 162, 235, 0.6)"></i>
                                <span class="text">
                                    <h3>{{ $available }}</h3>
                                    <p>Available Desks</p>
                                </span>
                            </li>

                            <li style="background-color:#dfe1e69c">
                                <i class='bx bx-table' style="background-color:rgba(255, 99, 132, 0.6);color:black"></i>
                                <span class="text">
                                    <h3>{{ $totalDesks }}</h3>
                                    <p>Total Desks</p>
                                </span>
                            </li>
                            <li style="background-color:#dfe1e69c">
                                <i class='bx bx-table' style="background-color:rgba(255, 206, 86, 0.6)"></i>
                                <span class="text">
                                    <h3>{{ $disabled }}</h3>
                                    <p>Disabled Desks</p>
                                </span>
                            </li>




                        </ul>

                        <div class="table-data">
                            <div class="order" style="background-color:#dfe1e69c">
                                <div class="head">
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                                    <canvas id="bookingsChart" width="1000" height="200"></canvas>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            fetch('/bookings/analytics')
                                                .then(response => response.json())
                                                .then(data => {
                                                    const ctx = document.getElementById('bookingsChart').getContext('2d');
                                                    new Chart(ctx, {
                                                        type: 'line',
                                                        data: {
                                                            labels: data.dates,
                                                            datasets: [{
                                                                label: 'Desks Usage',
                                                                data: data.counts,
                                                                backgroundColor: 'rgba(54, 162, 235, 0.4)',
                                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                                borderWidth: 1,
                                                                fill: true,
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                x: {
                                                                    beginAtZero: true
                                                                },
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                        }
                                                    });
                                                });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="box-info">


                    <li style="background-color:#dfe1e69c">
                        <i class='bx bxs-group' style="background-color:lightgreen;color:black"></i>
                        <span class="text">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Total Users</p>
                        </span>
                    </li>
                    <li style="background-color:#dfe1e69c">
                        <i class='bx bxs-group' style="background-color:lightgreen;color:black"></i>
                        <span class="text">
                            <h3>{{ $adminCount }}</h3>
                            <p> Admin</p>
                        </span>
                    </li>
                    <li style="background-color:#dfe1e69c">
                        <i class='bx bxs-group' style="background-color:lightblue;color:black"></i>
                        <span class="text">
                            <h3>{{ $managerCount }}</h3>
                            <p>Office Manager</p>
                        </span>
                    </li>
                    <li style="background-color:#dfe1e69c">
                        <i class='bx bxs-group' style="background-color:pink;color:black"></i>
                        <span class="text">
                            <h3>{{ $super_admin }}</h3>
                            <p>Super Admin</p>
                        </span>
                    </li>
                    <li style="background-color:#dfe1e69c">
                        <i class='bx bxs-group' style="background-color:pink;color:black"></i>
                        <span class="text">
                            <h3>{{ $normal }}</h3>
                            <p>Normal Users</p>
                        </span>
                    </li>
                </ul>
            @endunless

            <br>
            <p style="font-size:30px">Booking Overview</p>


            <div class="table-data">
                <div class="order" style="background-color:#dfe1e69c">
                    {{ $bookings->links() }}
                    <div class="head">
                        <table>
                            <tr>
                                <th>Desk Number</th>
                                <th>Image</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($bookings as $booking)
                                <tr>
                                    @php
                                        $today = Carbon\Carbon::now()->toDateString();
                                        $book_date = \App\Models\AvailableDesk::find($booking->available_desk_id)->date;
                                        $status =
                                            $booking->auto_accept == '1'
                                                ? ($today == $book_date
                                                    ? 'Ongoing'
                                                    : 'Accepted')
                                                : ($booking->status == 'pending'
                                                    ? 'Pending'
                                                    : ($today == $book_date
                                                        ? 'Ongoing'
                                                        : 'Accepted'));
                                    @endphp
                                    <td>
                                        Desk {{ \App\Models\Desk::find($booking->desk_id)->desk_number }}
                                    </td>
                                    <td>
                                        @php
                                            $deskNumber = \App\Models\Desk::find($booking->desk_id)->desk_number;
                                        @endphp
                                        <img src="{{ asset('images/desks/' . $deskNumber . '.png') }}" alt=""
                                            style="width:50px;height:50px; border-radius:0px;object-fit:cover"
                                            id="desk_image">
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
                                        <form method="post" action="/profile/bookings/{{ $booking->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="status bg-dangerRed !text-white">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>



        </main>
    </section>


    <!-- CONTENT -->

    <script src="{{ asset('js/booking.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


</x-layout>
