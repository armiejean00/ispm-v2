<x-layout :cssPaths="$cssPaths" :title="$title">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        .left .cover img {
            height: 100px;
            border-radius: 50px;
            display: block;
            margin: 0 auto;

        }

        .cover {
            background-color: #3a425f;
            background-position: center;
            background-size: cover;
            height: 150px;

        }

        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;

        }



        /* * {
        border:1px solid red;
    } */
    </style>


    <style>
        .toggle-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .toggle-button:focus {
            outline: none;
        }

        .toggle-button:hover {
            background-color: #0056b3;
        }

        .show-form {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .error-message {
            color: red;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }
    </style>


    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8;
        }

        .profile-button {
            background: #BA68C8;
            box-shadow: none;
            border: none;
        }

        .profile-button:hover {
            background: #682773;
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none;
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none;
        }

        .back:hover {
            color: #682773;
            cursor: pointer;
        }

        .form-group input[type="text"] {
            border-radius: 10px;
        }
    </style>



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
                <form method="POST" action="/logout" style="display: block">
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


        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>



            <div class="left">
                <div class="cover">
                    <img src="{{ asset('images/' . auth()->user()->profile_image) }}" alt="Profile Image"
                        style="height:150px;width:150px;border-radius:75px;object-fit:cover">

                </div>
                <div class="profile" style="margin-top:10px">







                    <div class="container">


                        <form action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data"
                            style="display:flex;margin-left:300px">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="file" name="profile_image" id="profile_image" required><br>

                            </div>
                            <button type="submit" style="height:40px">Update Image</button>
                        </form>
                        <br>
                        <br>






                        <div class="container rounded bg-gray mt-5">
                            <h2 class="settings-heading mt-3">Settings</h2>
                            <hr style="border-color: yellowgreen;">
                            <br>
                            <h4>Profile</h4>
                            <p class="ml-4">Update your profile and personal details here.</p>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <form method="POST" action="{{ route('profile.customize') }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="fullName" name="first_name"
                                                placeholder="First Name" value="{{ $user->first_name }}">
                                            @error('first_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="phoneNumber" name="last_name"
                                                placeholder="Last Name" value="{{ $user->last_name }}">
                                            @error('last_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>


                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="phoneNumber" name="email"
                                            placeholder="Email" value="{{ $user->email }}">
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Username" value="{{ $user->username }}">
                                        @error('username')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <input type="text" class="form-control" id="phoneNumber" name="bio"
                                            placeholder="Bio" value="{{ $user->bio }}" style="height:80px;">
                                        @error('bio')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-4">
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md">Update
                                            Information</button>
                                        <a href="/profile"
                                            class="ml-2 px-4 py-2 bg-gray-300 text-black rounded-md">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <br>
                            <hr style="border-color: yellowgreen;">
                            <div class="text-center">
                                <br>
                                <p>How is your experience with our Hotdesking?</p>
                                <button class="btn btn-primary profile-button mt-3" type="s"
                                    style="background-color: #8A2BE2; width: 150px;">
                                    <a href="/feedback" style="color: white; text-decoration: none;">Feedback</a>
                                </button>
                            </div>
                            <br>
                        </div>









                        {{-- <form method="POST" action="{{ route('profile.customize') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-black-700">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" style="color:black;height:40px" >
                @error('first_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium text-black-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" style="color:black;height:40px">
                @error('last_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-black-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" style="color:black;height:40px">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Information</button>
                <a href="/profile" class="ml-2 px-4 py-2 bg-gray-300 text-black rounded-md">Cancel</a>
            </div>
        </form>
 --}}






                    </div>





        </main>

    </section>

    <script src="{{ asset('js/booking.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#saveChangesBtn').click(function() {
                $('#profileForm').submit();
            });
        });
    </script>

</x-layout>
