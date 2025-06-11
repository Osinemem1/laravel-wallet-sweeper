<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel Wallet Automation Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Enable dark mode with class strategy -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        #sidebar {
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }

        #sidebar.open {
            transform: translateX(0);
        }

        @media (min-width: 768px) {
            #sidebar {
                transform: translateX(0) !important;
                position: relative !important;
            }
        }

        #overlay {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
            position: fixed;
            inset: 0;
            z-index: 10;
        }

        #overlay.show {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>

<body class="bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-gray-200 font-sans transition-colors duration-300">
    <div class="flex flex-col md:flex-row h-screen relative">
        <!-- Overlay -->
        <div id="overlay" tabindex="-1" aria-hidden="true"></div>

        <!-- Sidebar -->

        @include('partials.sidebar')

        
        <main class="flex-1 flex flex-col overflow-y-auto">
      <!-- Topbar -->
      @include('partials.header')

   @include('partials.scripts')

        <!-- Main Content -->

        @yield('content')

          

  </main>
  
    </div>


    @include('partials.footer')
</body>

</html>
