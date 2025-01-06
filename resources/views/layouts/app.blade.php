<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png')}}" type="image/x-icon">
    <title>E-Permits</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body style="background-color: #F4F4F2;">

    @auth
    <!-- Sidebar hanya untuk Admin -->
    @if(auth()->user()->role == 'admin')
    <nav class="fixed top-0 z-50 w-full border-b border-gray-200 shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <div class="flex items-center justify-start rtl:justify-end">
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="{{ asset('assets/favicon.png')}}" class="h-8 me-3" alt="Nav Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SMANTA</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <a class="block px-4 py-2 text-sm rounded-lg bg-blue-800 text-white font-semibold hover:bg-blue-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full pb-4 overflow-y-auto bg-white dark:bg-gray-800 ">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route(name: 'dashboard') }}"
                        class="flex items-center px-7 p-2  dark:text-white 
                  hover:bg-blue-100 hover:text-blue-800 dark:hover:bg-gray-700 group w-60 rounded-r-lg 
                  {{ request()->routeIs(patterns: 'dashboard') ? 'bg-blue-100 text-blue-800 border-l-4 border-blue-800' : '' }}">
                        <i class="fa-solid fa-people-roof w-5 h-5 transition duration-75 text-inherit group-hover:text-inherit dark:text-inherit"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teach.index') }}"
                        class="flex items-center px-7 p-2  dark:text-white 
                  hover:bg-blue-100 hover:text-blue-800 dark:hover:bg-gray-700 group w-60 rounded-r-lg 
                  {{ request()->routeIs('teach.index') ? 'bg-blue-100 text-blue-800 border-l-4 border-blue-800' : '' }}">
                        <i class="fa-solid fa-user-graduate w-5 h-5 transition duration-75 text-inherit group-hover:text-inherit dark:text-inherit"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.index') }}"
                        class="flex items-center px-7 p-2  dark:text-white 
                  hover:bg-blue-100 hover:text-blue-800 dark:hover:bg-gray-700 group w-60 rounded-r-lg 
                  {{ request()->routeIs('siswa.index') ? 'bg-blue-100 text-blue-800 border-l-4 border-blue-800' : '' }}">
                        <i class="fa-solid fa-user w-5 h-5 transition duration-75 text-inherit group-hover:text-inherit dark:text-inherit"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('permits.index') }}"
                        class="flex items-center px-7 p-2  dark:text-white 
                  hover:bg-blue-100 hover:text-blue-800 dark:hover:bg-gray-700 group w-60 rounded-r-lg 
                  {{ request()->routeIs('permits.index') ? 'bg-blue-100 text-blue-800 border-l-4 border-blue-800' : '' }}">
                        <i class="fa-solid fa-book w-5 h-5 transition duration-75 text-inherit group-hover:text-inherit dark:text-inherit"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cetak.index') }}"
                        class="flex items-center px-7 p-2  dark:text-white 
                  hover:bg-blue-100 hover:text-blue-800 dark:hover:bg-gray-700 group w-60 rounded-r-lg 
                  {{ request()->routeIs('cetak.index') ? 'bg-blue-100 text-blue-800 border-l-4 border-blue-800' : '' }}">
                        <i class="fa-solid fa-print w-5 h-5 transition duration-75 text-inherit group-hover:text-inherit dark:text-inherit"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Cetak</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Navbar untuk Guru -->
    @elseif(auth()->user()->role == 'guru')
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/favicon.png')}}" class="h-8" alt="Nav Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Permits Guru</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li class="mb-3">
                        <a href="{{ route('dashboard') }}"
                            class="block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:text-black md:p-0 md:dark:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-800' : '' }}">
                            <span class="ms-3">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('teacher.index') }}"
                            class="block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:text-black md:p-0 md:dark:text-white {{ request()->routeIs('teacher.index') ? 'bg-blue-100 text-blue-800' : '' }}">
                            <span class="ms-3">Perizinan</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <!-- Navbar untuk Siswa -->
    @elseif(auth()->user()->role == 'siswa')
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/favicon.png')}}" class="h-8" alt="Nav Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Permits Siswa</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li class="mb-3">
                        <a href="{{ route('dashboard') }}"
                            class="block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:text-black md:p-0 md:dark:text-white {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-800' : '' }}">
                            <span class="ms-3">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.index') }}"
                            class="block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:text-black md:p-0 md:dark:text-white {{ request()->routeIs('student.index') ? 'bg-blue-100 text-blue-800' : '' }}">
                            <span class="ms-3">Perizinan</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    
    @endif
    @endauth
    @if(auth()->user()->role == 'admin')
    <main class="p-4 mt-20 sm:ml-64">
        @yield('content')
    </main>
    @elseif(auth()->user()->role == 'guru')
    <main class="px-5 mt-20">
        @yield('content')
    </main>
    @elseif(auth()->user()->role == 'siswa')
    <main class="px-5 mt-20">
        @yield('content')
    </main>
    @endif
    <!-- <footer class="bg-light text-center py-3 mt-4">
        &copy; {{ date('Y') }} Perizinan. All rights reserved.
    </footer> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>