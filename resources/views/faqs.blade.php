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

        </ul>
        <ul class="side-menu">
            <li class="active">
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
        <section>

            <div class="background-section">

                <div class="faqs-section">
                    <h2>Frequently Asked Questions</h2>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>What is hotdesking and how does it work in our system?</h3>
                        <p>Hotdesking is a flexible office arrangement where employees do not have assigned desks, but
                            instead can choose from a pool of available workstations each day. In our system, employees
                            can book a desk through our online platform or mobile app</p>
                    </div>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>How do I reserve a hotdesk in our system?</h3>
                        <p>To reserve a hotdesk, employees can log into our system using their credentials and access
                            the hotdesking feature. They can view the availability of desks for a specific date and
                            time, and select a desk that suits their requirements. Once they have made a reservation,
                            the desk will be reserved under their name for the designated time slot.</p>
                    </div>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>Can I reserve a hotdesk in advance?</h3>
                        <p>Yes, our system allows employees to reserve hotdesks in advance. They can book a desk for a
                            future date and time, ensuring they have a workspace available when they need it. However,
                            it is important to note that reservations are subject to availability, so it is advisable to
                            book in advance to secure a desired desk.</p>
                    </div>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>Can I cancel my hotdesk booking?</h3>
                        <p>Yes, you can usually cancel your booking through our website's booking management system.
                            However, cancellation and modification policies may vary, so it's advisable to check our
                            website's terms and conditions or contact our customer support for assistance.</p>
                    </div>


                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>How long can I use a hotdesk?</h3>
                        <p>In our hotdesking system, employees can use a desk for the designated time slot they have
                            reserved. The time could be a few hours, half a day, or a full day, depending on their
                            preference and availability. If employees need to extend their usage beyond the reserved
                            time, they can check for availability and make an additional reservation if necessary.</p>
                    </div>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>Can I personalize my hotdesk?</h3>
                        <p>As hotdesking promotes flexibility and shared workspaces, personalization options may vary.
                            However, employees are generally allowed to bring personal items such as laptops, documents,
                            and small desk accessories to their chosen desk for the day. It is important to ensure that
                            personal items are removed at the end of the day to keep the desk clean and ready for the
                            next user.</p>
                    </div>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>Can I choose the same hotdesk every day?</h3>
                        <p>While our hotdesking system offers flexibility and the ability to choose from available
                            desks, it does not guarantee the same desk every day. The availability of desks and the
                            overall concept of hotdesking is based on a first-come, first-served basis. Employees can
                            choose any available desk each day, depending on their needs and preferences.</p>
                    </div>

                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>How can I find an available hotdesk quickly?</h3>
                        <p>Our hotdesking system provides real-time information on desk availability through our online
                            platform or mobile app. Employees can easily view the available desks for a specific date
                            and time, and select the one that suits them best. This ensures a hassle-free and efficient
                            process in finding a suitable hotdesk quickly.</p>
                    </div>
                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>What if I encounter issues with my hotdesk reservation?</h3>
                        <p>If employees encounter any issues related to their hotdesk reservations, such as a desk being
                            occupied despite the reservation or any technical difficulties with the system, they should
                            contact the designated support team or the office administrator for assistance. They will
                            help resolve any concerns and ensure a seamless experience with the hotdesking system.</p>
                    </div>
                    <div class="faq-item" onclick="toggleAnswer(this)">
                        <h3>Can I collaborate with colleagues while using a hotdesk?</h3>
                        <p>Absolutely! Our hotdesking system is designed to promote collaboration and flexibility within
                            the office space. Employees can utilize common areas, meeting rooms, or designated
                            collaboration spaces to work together, have discussions, or share ideas. The hotdesk setup
                            allows for easy interaction and encourages a dynamic work environment.</p>
                    </div>

                </div>

            </div>

        </section>
    </section>

    <script src="{{ asset('js/faqs.js') }}"></script>

</x-layout>
