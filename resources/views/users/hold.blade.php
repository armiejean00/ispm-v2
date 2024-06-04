<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ApexHubSpot</title>
    @vite('resources/css/app.css')
</head>

<body class="font-semibold">
    {{-- NavBar --}}
    <nav class="relative container mx-auto p-4 text-center md:p-6">
        {{-- Flex Container --}}
        <div class="flex items-center justify-between">
            {{-- Logo --}}
            <a href="/" class="pt-2">
                <h1 class="font-bold text-2xl text-congressBlue lg:text-3xl">
                    <img class="display: inline-block h-8 pb-2 lg:h-10 lg:pb-3" src="{{ asset('images/ahs-ape.svg') }}"
                        alt="A">pexHubSpot
                </h1>
            </a>

        </div>
    </nav>

    <section>
        <div class="container mx-auto w-auto rounded-md text-center md:bg-slate-300 md:shadow-xl md:p-4 md:w-96">
            <h2 class="text-base mb-5">
                Your account is on hold or not approved. Please contact your administrator to give you access.
            </h2>
            <a href="/"
                class="p-3 px-6 pt-2 text-white bg-congressBlue hover:bg-cornflowerBlue rounded-full baseline text-lg lg:text-xl">
                Back
            </a>
        </div>
    </section>
</body>

</html>
