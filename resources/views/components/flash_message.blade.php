@if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-yellow-300 text-gray-900 px-48 py-3 z-30 text-center">
        <p>
            {{ session('message') }}
        </p>
    </div>
@elseif(session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-androidGreen text-emerald-900 px-48 py-3 z-30 text-center">
        <p>
            {{ session('success') }}
        </p>
    </div>
@elseif (session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-red-300 text-mulberryWood px-48 py-3 z-30 text-center">
        <p>
            {{ session('error') }}
        </p>
    </div>
@endif
