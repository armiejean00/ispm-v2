<x-layout :cssPaths="$cssPaths" :title="$title">
    <style>
        .active-tab {
            background-color: #8a63d2;
            color: #ffffff;
        }

        .active-tab svg {
            stroke: #ffffff;
        }

        .tab-item {
            padding: 12px 24px;
        }

        .tab-image {
            width: auto;
            height: auto;
            max-width: auto;
        }
    </style>

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
            <li>
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
                    @if (auth()->user()->role == 'user')
                        <i class='bx bxs-book bx-sm'></i>
                        <span class="text">Booking</span>
                    @else
                        <i class='bx bx-desktop bx-sm'></i>
                        <span class="text">Manage Desks</span>
                    @endif
                </a>
            </li>
            {{-- <li>
                <a href="/roles">
                    <i class='bx bx-user-pin bx-sm'></i>
                    <span class="text">Manage Roles</span>
                </a>
            </li> --}}
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/faqs">
                    <i class='bx bx-question-mark bx-sm'></i>
                    <span class="text">FAQs</span>
                </a>
            </li>
            <li class="active">
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
        <section style="margin-left:150px">
            <div class="background-section">


                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-12 mx-auto flex flex-wrap flex-col">
                        <div class="flex mx-auto flex-wrap mb-10" id="tab-container">
                            <a class="tab-item sm:px-6 py-4 w-full sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-indigo-500 text-indigo-500 tracking-wider rounded-t active-tab"
                                onclick="navigateTab(event, 'creating-account')">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-8 h-8 mr-4 text-indigo-500" viewBox="0 0 24 24">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>Creating an Account
                            </a>
                            <a class="tab-item sm:px-6 py-4 w-full sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-indigo-500 text-indigo-500 tracking-wider"
                                onclick="navigateTab(event, 'register')">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-8 h-8 mr-4 text-gray-500" viewBox="0 0 24 24">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                </svg>Register
                            </a>
                            <a class="tab-item sm:px-6 py-4 w-full sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-indigo-500 text-indigo-500 tracking-wider"
                                onclick="navigateTab(event, 'logging-in')">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-8 h-8 mr-4 text-gray-500" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="3"></circle>
                                    <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
                                </svg>Logging In
                            </a>
                            <a class="tab-item sm:px-6 py-4 w-full sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-indigo-500 text-indigo-500 tracking-wider"
                                onclick="navigateTab(event, 'booking')">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-8 h-8 mr-4 text-gray-500"
                                    viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>Booking
                            </a>
                        </div>
                        <div class="text-gray-900 text-center mb-6" id="tab-instructions">
                            <p class="lg:w-2/3 mx-auto leading-relaxed text-lg" style="color:rgb(160, 152, 152)"></p>
                        </div>
                        <img class="xl:w-2/3 lg:w-1/2 md:w-2/3 w-full block mx-auto mb-10 object-cover object-center rounded tab-image"
                            id="tab-image" alt="hero">
                        <div class="flex flex-col text-center w-full">
                            <div class="text-white-900" id="tab-content">
                                <h1 class="text-3xl font-medium title-font mb-6 text-gray-900">Get Started</h1>
                                <p class="lg:w-2/3 mx-auto leading-relaxed text-lg">Open the website and click on the
                                    "Get Started"
                                    .</p>
                            </div>
                        </div>
                    </div>
                </section>

                <script>
                    function navigateTab(event, tabId) {
                        const tabContainer = document.getElementById('tab-container');
                        const tabs = tabContainer.getElementsByClassName('active-tab');
                        for (const tab of tabs) {
                            tab.classList.remove('active-tab');
                        }
                        event.currentTarget.classList.add('active-tab');

                        const content = document.getElementById('tab-content');
                        const instructions = document.getElementById('tab-instructions');
                        switch (tabId) {
                            case 'creating-account':
                                content.innerHTML =
                                    '<h1 class="text-3xl font-medium title-font mb-6 text-gray-900"> </h1><p class="lg:w-2/3 mx-auto leading-relaxed text-lg"> </p>';
                                instructions.querySelector('p').textContent =
                                    'To create an account, visit the website and click on the "Get Started".';
                                document.getElementById('tab-image').src = 'images/start.png';
                                break;
                            case 'register':
                                content.innerHTML =
                                    '<h1 class="text-3xl font-medium title-font mb-6 text-gray-900"> </h1><p class="lg:w-2/3 mx-auto leading-relaxed text-lg"> </p>';
                                instructions.querySelector('p').textContent =
                                    'To register, fill out the required information. After completing the registration, your account will be temporarily hold.';
                                document.getElementById('tab-image').src = 'images/signup.jpg';

                                break;
                            case 'logging-in':
                                content.innerHTML =
                                    '<h1 class="text-3xl font-medium title-font mb-6 text-gray-900"> </h1><p class="lg:w-2/3 mx-auto leading-relaxed text-lg"> </p>';
                                instructions.querySelector('p').textContent =
                                    'To log in, enter your username and password, then click the "Enter" button.';
                                document.getElementById('tab-image').src = 'images/login.jpg';
                                break;
                            case 'booking':
                                content.innerHTML =
                                    '<h1 class="text-3xl font-medium title-font mb-6 text-gray-900"> </h1><p class="lg:w-2/3 mx-auto leading-relaxed text-lg"> </p>';
                                instructions.querySelector('p').textContent =
                                    'To make a booking, navigate to your booking page Search your desired date and choose your desk, then confirm your booking.';
                                document.getElementById('tab-image').src = 'images/book.png';
                                break;
                            default:
                                break;
                        }
                    }

                    window.onload = function() {
                        document.querySelector('.active-tab').click();
                    };
                </script>

            </div>
        </section>
    </section>

</x-layout>
