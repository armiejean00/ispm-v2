<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHS</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>


</head>


<body>
    <header>
        <a href="#" class="logolanding">
            <img src="{{ asset('images/ahs-logo.svg') }}" alt="">
        </a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <ul class="navbar">
            <li> <a href="#home">Home</a></li>
            <li> <a href="#about">FAQ's</a></li>

            <li> <a href="#userguide">User Guide</a></li>
            <li> <a href="#team">Our Team</a></li>
            {{-- <li> <a href="#contact">Contact Us</a></li> --}}
        </ul>
        <div class="header-icon" style="background-color:#08C6AB;border-radius:5px">
            <a href="/users/sign_in" style="font-size: 15px;margin:5px;color:black;">Get Started</a>



        </div>



    </header>

    <section class="home" id="home">
        <div class="home-text">
            <h1>Where Flexibility Meets Productivity<br>
                in Every Seat</h1>
            <p>Step into the future of work with Hotdesk, where the landscape of productivity transforms.<br>
                Unleash Your Productivity, Any Seat, Anytime.</p>

        </div>

    </section>

    <section id="about" class="text-gray-300 body-font bg-gray-900">
        <div class="container flex flex-wrap">
            <div class="lg:w-1/2 w-full mb-10 lg:mb-0 rounded-lg overflow-hidden">
                <br>
                <img alt="feature" class="object-center" src="images/hotdesk.jpg"> <br>
                <img alt="feature" class="object-center" src="images/hotdesks.jpg">

            </div>
            <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center">
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div
                        class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <img src="images/laptop.webp" alt="Laptop Icon" class="w-6 h-6">
                    </div>
                    <div class="flex-grow">
                        <h1 class="text-blue-400 text-xl title-font font-bold mb-4">What is Hotdesking?</h1>
                        <p class="leading-relaxed text-base">Hotdesking is a flexible office arrangement where employees
                            do not have assigned desks, but instead can choose from a pool of available workstations
                            each day. In our system, employees can book a desk through our online platform or mobile
                            app.</p>
                    </div>
                </div>
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div
                        class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <img src="images/service.jpg" alt="Service Icon" class="w-6 h-6">
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-blue-400 text-xl title-font font-bold mb-4">Service We Offer</h2>
                        <p class="leading-relaxed text-base">To reserve a hotdesk, employees can log into our system
                            using their credentials and access the hotdesking feature. They can view the availability of
                            desks for a specific date and time, and select a desk that suits their requirements. Once
                            they have made a reservation, the desk will be reserved under their name for the designated
                            time slot.</p>
                    </div>
                </div>
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div
                        class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <img src="images/more.png" alt="Info Icon" class="w-6 h-6">
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-blue-400 text-xl title-font font-bold mb-4">Additional</h2>
                        <p class="leading-relaxed text-base">In our hotdesking system, employees can use a desk for the
                            designated time slot they have reserved. The time is full day, depending on their preference
                            and availability.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section id="userguide" class="text-gray-300 body-font bg-gray-900">
        <div class="container flex flex-wrap">

            <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center">
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div
                        class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <img src="images/question.jpg" alt="Laptop Icon" class="w-6 h-6">
                    </div>
                    <div class="flex-grow">
                        <h1 class="text-blue-400 text-xl title-font font-bold mb-4">How To Create an Account?</h1>
                        <p class="leading-relaxed text-base">Click the "Get Started" button and fill out the form</p>
                    </div>
                </div>
                <div class="flex flex-col mb-10 lg:items-start items-center">

                </div>

            </div>

            <div class="lg:w-1/2 w-full mb-10 lg:mb-0 rounded-lg overflow-hidden">
                <br>

                <img alt="feature" class="object-center" src="images/signup.jpg">


            </div>
        </div>

        <div class="container flex flex-wrap">

            <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center">
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div
                        class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
                        <img src="images/question.jpg" alt="Laptop Icon" class="w-6 h-6">
                    </div>
                    <div class="flex-grow">
                        <h1 class="text-blue-400 text-xl title-font font-bold mb-4">How To Login?</h1>
                        <p class="leading-relaxed text-base">Enter your Username and Password to Access the system</p>
                    </div>
                </div>
                <div class="flex flex-col mb-10 lg:items-start items-center">

                </div>

            </div>

            <div class="lg:w-1/2 w-full mb-10 lg:mb-0 rounded-lg overflow-hidden">
                <br>

                <img alt="feature" class="object-center" src="images/login.jpg">


            </div>
        </div>

    </section>


    <br>

    <section id="team" class="team" style="background-color: #eaeaeb;">
        <div class="heading">
            <h2>Meet the TEAM</h2>
        </div>
        <div class="customers-container">
            <div class="box">
                <div class="stars">


                    <a href="https://github.com/zafiedvwn" target="_blank"><i class='bx bxl-github'></i></a>

                </div>

                <p>Project Manager</p>
                <h2>Aurora Zafra Bactol</h2>
                <div style="margin-left:140px">
                    <img src="{{ asset('images/aurora.jpg') }}" alt="">
                </div>

            </div>
            <div class="box">
                <div class="stars">
                    <a href="https://www.facebook.com/HMR36" target="_blank"><i class='bx bxl-facebook'></i></a>

                    <a href="https://github.com/Harry-Reyes" target="_blank"><i class='bx bxl-github'></i></a>
                    <a href="https://gitlab.com/Harry-Reyes" target="_blank"><i class='bx bxl-gitlab'></i></a>

                </div>

                <p>Lead Developer</p>
                <h2>Harry Reyes</h2>
                <div style="margin-left:140px">
                    <img src="{{ asset('images/harry.gif') }}" alt="">
                </div>
            </div>
            <div class="box">
                <div class="stars">
                    <a href="https://www.facebook.com/jshallador19" target="_blank"><i
                            class='bx bxl-facebook'></i></a>

                    <a href="https://github.com/Josu119" target="_blank"><i class='bx bxl-github'></i></a>

                </div>

                <p>Co-Developer</p>
                <h2>Joshua Allador</h2>
                <div style="margin-left:140px">
                    <img src="{{ asset('images/joshua.png') }}" alt="">
                </div>
            </div>
            <div class="box">
                <div class="stars">
                    <a href="https://www.facebook.com/armie.miranda18/" target="_blank"><i
                            class='bx bxl-facebook'></i></a>

                    <a href="https://github.com/armiejean00" target="_blank"><i class='bx bxl-github'></i></a>
                    <a href="https://www.instagram.com/_t3rriee/" target="_blank"><i
                            class='bx bxl-instagram'></i></a>
                </div>

                <p>UI/UX Design Lead</p>
                <h2>Armie Jean Miranda</h2>
                <div style="margin-left:140px">
                    <img src="{{ asset('images/armie.png') }}" alt="">
                </div>
            </div>
            <div class="box">
                <div class="stars">
                    <a href="https://www.facebook.com/Paula.Soleil.Jabinal" target="_blank"><i
                            class='bx bxl-facebook'></i></a>

                    <a href="https://github.com/Leisol" target="_blank"><i class='bx bxl-github'></i></a>
                    <a href="https://www.instagram.com/p.soleil.s.j/" target="_blank"><i
                            class='bx bxl-instagram'></i></a>
                </div>

                <p>Co-Developer</p>
                <h2>Paula Soleil Jabinal</h2>
                <div style="margin-left:140px">
                    <img src="{{ asset('images/paula.jpg') }}" alt="">
                </div>
            </div>
            <div class="box">
                <div class="stars">
                    <a href="https://www.facebook.com/jossamarie.advincula" target="_blank"><i
                            class='bx bxl-facebook'></i></a>


                    <a href="https://www.instagram.com/josh_mariahh/" target="_blank"><i
                            class='bx bxl-instagram'></i></a>
                </div>

                <p>Project Coordinator</p>
                <h2>Jossa Marie Advincula</h2>
                <div style="margin-left:140px">
                    <img src="{{ asset('images/jossa.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>




    <br>









    <div class="copyright">
        <p>&#169; AHS </p>
    </div>




    <script src="{{ asset('javascript/index.js') }}"></script>
</body>

</html>
