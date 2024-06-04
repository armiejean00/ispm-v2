<x-layout :cssPaths="$cssPaths" :title="$title">

    <!-- SIDEBAR -->
    <section id="sidebar" class="hide">
        <a href="#" class="brand">
            <img src="{{ asset('images/main/logo.png') }}" alt="" style="width:60px">
        </a>
        <ul class="side-menu top">
            <li>
                <a href="/dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="/bookings">
                    <i class='bx bxs-book-alt'></i>
                    <span class="text">Booking</span>
                </a>
            </li>
            <li>
                <a href="/office_map">
                    <i class='bx bxs-map'></i>
                    <span class="text">Office Map</span>
                </a>
            </li>
            <li>
                <a href="/users">
                    <i class='bx bxs-group'></i>
                    <span class="text">Manage Users</span>
                </a>
            </li>

            <li>
                <a href="/desks">
                    <i class='bx bx-desktop'></i>
                    <span class="text">Manage Desks</span>
                </a>
            </li>
            <li>
                <a href="/roles">
                    <i class='bx bx-user-pin'></i>
                    <span class="text">Manage Roles</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/faqs">
                    <i class='bx bx-question-mark'></i>
                    <span class="text">FAQs</span>
                </a>
            </li>
            <li>
                <a href="/guide">
                    <i class='bx bxs-component'></i>
                    <span class="text">User Guide</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <p>ApexHubSpot</p>

            <form action="#">
                <div class="form-input">

                </div>
            </form>

            {{-- <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> --}}
            <a href="/profile" class="profile">
                Profile
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Bookings History</h1>
                    <a href="/bookings"
                        style="color: rgb(24, 111, 211);padding: 10px 20px;border: 1px solid black;border-radius: 10px;">Show
                        Bookings</a>

                </div>

            </div>
            <div class="table-data">
                <div class="order">
                    <div class="head">


                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Office</th>
                                <th>Desk</th>
                                <th>Date </th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>John Doe</p>
                                </td>

                                <td>Office 1</td>
                                <td>3C</td>

                                <td>01-10-2021</td>
                                <td>10:00AM</td>
                                <td><span class="status completed">Done</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>John Doe</p>
                                </td>

                                <td>Office 1</td>
                                <td>3C</td>

                                <td>01-10-2021</td>
                                <td>10:00AM</td>
                                <td><span class="status completed">Done</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>John Doe</p>
                                </td>

                                <td>Office 1</td>
                                <td>3C</td>

                                <td>01-10-2021</td>
                                <td>10:00AM</td>
                                <td><span class="status completed">Done</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>John Doe</p>
                                </td>

                                <td>Office 1</td>
                                <td>3C</td>

                                <td>01-10-2021</td>
                                <td>10:00AM</td>
                                <td><span class="status completed">Done</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>John Doe</p>
                                </td>

                                <td>Office 1</td>
                                <td>3C</td>

                                <td>01-10-2021</td>
                                <td>10:00AM</td>
                                <td><span class="status completed">Done</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>John Doe</p>
                                </td>

                                <td>Office 1</td>
                                <td>3C</td>

                                <td>01-10-2021</td>
                                <td>10:00AM</td>
                                <td><span class="status completed">Done</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>

        </main>

    </section>

</x-layout>
