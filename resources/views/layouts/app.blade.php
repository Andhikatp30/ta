<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="storage/images/logo2.png">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-gradient-to-b from-sky-400 to-indigo-500 text-white p-6 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ url('storage/images/logo2.png') }}" alt="Admin Dashboard Logo" class="h-12">
                </a>
                <!-- <h1 class="text-xl font-bold">Admin Dashboard</h1> -->
            </div>
            <div class="flex items-center space-x-4">
                <!-- Hamburger menu toggle -->
                <button id="menu-toggle" class="lg:hidden focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- User icon with dropdown, hidden on mobile -->
                @if(Auth::check())
                    <div class="relative hidden lg:flex lg:items-center lg:space-x-2">
                        <span>{{ Auth::user()->name }}</span>
                        <button id="user-icon" class="focus:outline-none relative">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white text-black rounded-lg shadow-lg hidden"
                            style="top: calc(100% + 8px); right: 0;">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm hover:bg-gray-200 rounded-t-lg">Profile</a>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm hover:bg-gray-200 rounded-b-lg"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="flex flex-col lg:flex-row min-h-screen bg-gray-100">
       <!-- Sidebar -->
        @if(Auth::check())
            <div id="sidebar" class="w-full lg:w-64 bg-gradient-to-t from-sky-400 to-indigo-500 text-white lg:min-h-screen lg:block hidden">
                <div class="p-6 border-b border-blue-700">
                    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                </div>
                <nav>
                    <ul>
                        <!-- Sidebar content -->
                        <li class="p-4 hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <a href="{{ route('dashboard') }}" class="flex items-center rounded">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                        </li>
                        <!-- Data Barang -->
                        <li class="p-4 hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <div x-data="{ open: false }">
                                <button @click="open = ! open" class="flex items-center w-full text-left rounded">
                                    <i class="fas fa-boxes mr-2"></i> Data Barang
                                    <i class="fas fa-chevron-down ml-auto" x-show="!open"></i>
                                    <i class="fas fa-chevron-up ml-auto" x-show="open"></i>
                                </button>
                                <div x-show="open" class="pl-4 mt-2">
                                    <ul>
                                        <li>
                                            <a href="{{ route('barang.index') }}" class="block py-2 hover:bg-gradient-to-r from-sky-600 to-indigo-300 rounded">
                                                <i class="fas fa-list mr-2"></i> Daftar Barang
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="{{ route('barang.create') }}" class="block py-2 hover:bg-blue-800 rounded">
                                                <i class="fas fa-plus mr-2"></i> Tambah Barang
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Data Kurir -->
                        <li class="p-4 hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <div x-data="{ open: false }">
                                <button @click="open = ! open" class="flex items-center w-full text-left rounded">
                                    <i class="fas fa-truck mr-2"></i> Data Kurir
                                    <i class="fas fa-chevron-down ml-auto" x-show="!open"></i>
                                    <i class="fas fa-chevron-up ml-auto" x-show="open"></i>
                                </button>
                                <div x-show="open" class="pl-4 mt-2">
                                    <ul>
                                        <li>
                                            <a href="{{ route('kurir.index') }}" class="block py-2 hover:bg-gradient-to-r from-sky-600 rounded">
                                                <i class="fas fa-list mr-2"></i> Daftar Kurir
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="{{ route('kurir.create') }}" class="block py-2 hover:bg-blue-800 rounded">
                                                <i class="fas fa-plus mr-2"></i> Tambah Kurir
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Kinerja Kurir -->
                        <li class="p-4 hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <a href="{{ route('kinerja-kurir') }}" class="flex items-center rounded">
                                <i class="fas fa-chart-bar mr-2"></i> Kinerja Kurir
                            </a>
                        </li>
                        <!-- Pengiriman -->
                        <li class="p-4 hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <div x-data="{ open: false }">
                                <button @click="open = ! open" class="flex items-center w-full text-left rounded">
                                    <i class="fas fa-shipping-fast mr-2"></i> Pengiriman
                                    <i class="fas fa-chevron-down ml-auto" x-show="!open"></i>
                                    <i class="fas fa-chevron-up ml-auto" x-show="open"></i>
                                </button>
                                <div x-show="open" class="pl-4 mt-2">
                                    <ul>
                                        <li>
                                            <a href="{{ route('pengiriman.create') }}" class="block py-2 hover:bg-gradient-to-r from-sky-600 rounded">
                                                <i class="fas fa-plus mr-2"></i> Tambah Pengiriman
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pengiriman.status') }}" class="block py-2 hover:bg-gradient-to-r from-sky-600 rounded">
                                                <i class="fas fa-shipping-fast mr-2"></i> Status Pengiriman
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Histori Pengiriman -->
                        <li class="p-4 hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <a href="{{ route('pengiriman.histori') }}" class="flex items-center rounded">
                                <i class="fas fa-history mr-2"></i> Histori Pengiriman
                            </a>
                        </li>
                        <!-- Profile -->
                        <li class="p-4 block lg:hidden hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <a href="{{ route('profile.show') }}" class="flex items-center rounded">
                                <i class="fas fa-user-circle mr-2"></i> Profile
                            </a>
                        </li>
                        <!-- Logout -->
                        <li class="p-4 block lg:hidden hover:bg-gradient-to-r from-sky-300 to-indigo-700 transition duration-300">
                            <a href="{{ route('logout') }}" class="flex items-center rounded"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-sky-400 to-indigo-500 text-white p-6">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });

        document.getElementById('user-icon').addEventListener('click', function () {
            const userMenu = document.getElementById('user-menu');
            userMenu.classList.toggle('hidden');
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function (e) {
            const userIcon = document.getElementById('user-icon');
            const userMenu = document.getElementById('user-menu');
            if (!userIcon.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>

    @vite('resources/js/app.js')
</body>
</html>
