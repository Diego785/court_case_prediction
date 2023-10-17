<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}"> --}}

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- @vite('resources/css/app.css') --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <style>
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            /* Adjust width as needed */
            z-index: 1000;
            /* Adjust z-index to make sure it's above other content */
        }

        .main-content {
            margin-left: 5rem;
            /* Should match the width of the sidebar */
        }
    </style>
</head>

<body>
    {{-- @yield('navbar') --}}
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
        <div class="flex h-auto antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <div class="fixed-sidebar">
                <!-- Your sidebar content here -->
                @yield('sidebar')
            </div>
            <!-- Main content with the main-content class -->
            <div class="main-content">
                <!-- Your main content here -->
                @yield('content')
            </div>
        </div>
    </div>




    @yield('css')
    @yield('js')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    {{-- @stack('js') --}}
</body>

</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->

    <!-- Include necessary CSS and JavaScript libraries -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>

    <!-- Additional CSS styles for sidebar and content -->

</head>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Sidebar with the fixed-sidebar class -->



        </div>
    </div>
    <!-- Your other scripts and content here -->
</body>

</html>
