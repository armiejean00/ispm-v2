<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>ApexHubSpot</title>
    @vite(['resources/css/app.css', 'resources/css/main/default.css', 'resources/css/main/sidebar.css', ...$cssPaths])
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<style>
    /* Dark Mode Styles */
    body.dark-mode {
        background-color: #3c4557;
        color: #ffffff;
    }

    body.dark-mode #sidebar {
        background-color: #2b333e;
    }

    body.dark-mode .side-menu a {
        color: #ffffff;
    }

    body.dark-mode .side-menu a:hover {
        background-color: #1f2730;
    }

    body.dark-mode .side-menu button {
        background-color: #2b333e;
        color: #ffffff;
    }

    body.dark-mode .side-menu button:hover {
        background-color: #1f2730;
    }

    body.dark-mode .content {
        background-color: #3c4557;
        color: #ffffff;
    }

    /* Navbar */
    body.dark-mode nav {
        background-color: #3c4557;
    }

    /* Profile button */
    body.dark-mode .profile {
        background-color: #3c4557;
        color: #ffffff;
    }
</style>

<body>
    {{ $slot }}
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <x-flash_message />

    <section class="hide">

        {{-- <button id="darkModeToggle" class="toggle-dark-mode"> --}}
        <ul class="side-menu top">

            <li>
                <button id="darkModeToggle" class="toggle-dark-mode"
                    style="right:0;padding:15px;position:absolute;top:45px;border-radius:10px;background-color:rgb(248, 248, 248)">
                    <i class='bx bx-moon'style="color:black"></i>
                    <span class="text" style="color:black"></span>
                </button>
            </li>

        </ul>
    </section>




    <script src="{{ asset('js/booking.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('darkModeToggle');
            const toggleText = toggleButton.querySelector('.text');
            const toggleIcon = toggleButton.querySelector('i');

            toggleButton.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');

                // Toggle text and icon
                if (document.body.classList.contains('dark-mode')) {
                    // toggleText.textContent = 'Light Mode';
                    toggleIcon.classList.remove('bx-moon');
                    toggleIcon.classList.add('bx-sun');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    // toggleText.textContent = 'Dark Mode';
                    toggleIcon.classList.remove('bx-sun');
                    toggleIcon.classList.add('bx-moon');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });

            // Check the user's preference on page load
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                // toggleText.textContent = 'Light Mode';
                toggleIcon.classList.remove('bx-moon');
                toggleIcon.classList.add('bx-sun');
            }
        });
    </script>
</body>

</html>
