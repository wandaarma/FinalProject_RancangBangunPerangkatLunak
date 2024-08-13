<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Workspace</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/workspace/workspace.css') }}">
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/f92c007b9c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="template1">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}">
            </div>
            <div class="home">
                <div class="hometext">Home</div>
            </div>
            <div class="dropdown">
                <button class="btn dropdown-toggle" data-toggle="dropdown">Workspace</i></button>
                <div class="dropdown-menu">
                    @forelse ($data_kelompok as $dk)
                    <a class="dropdown-item" href="workspace/overview/{{ $dk->id }}">{{ $dk->title }}</a>
                    @empty
                    @endforelse
                </div>
            </div>

            <form class="search" onsubmit="return false">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="bell">
                <a href="{{ url('#') }}" type="button" class="btn"><i class="fa-regular fa-bell"></i></a>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6 profil">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-black dark:bg-gray-800 hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <div class="vertical-nav" id="sidebar">
            <li class="nav-item">
                <a href="{{ url('mytask') }}" class="nav-link">
                    <i class="fa-solid fa-pen-to-square"></i>
                    My Task
                </a>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link active">
                    <i class="fa-solid fa-list-check"></i>
                    Workspace
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('calendar') }}" class="nav-link">
                    <i class="fa-regular fa-calendar"></i>
                    Calendar
                </a>
            </li>
            <div class="linenav"></div>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-gear"></i>
                    Setting
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-regular fa-circle-info"></i>
                    Help
                </a>
            </li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="nav-item">
                    <a href="route('logout')" class="nav-link"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Log Out
                </a>
                </li>
            </form>
        </div>

        <div class="main1">
            <div class="main2">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <button class="btnjoingroup" id="joinButton" onclick="openPopup()">Join Group</button>
                <div id="overlay"></div>
                <div id="popup" class="popup">
                    <div class="popup2">
                        <span class="btnclosee" onclick="closePopup()">&times;<img
                                src="{{ asset('cross.png') }}"></span>
                        <form action="workspace/storecode" method="POST">
                            {{ csrf_field() }}
                            <div>
                                <input id="joingroup" name="joingroup" class="form-control joingroup" type="text"
                                    placeholder="Input your group code here" required="required" />
                            </div>
                            <input class="btn btnjoin" type="submit" value="JOIN">
                        </form>
                    </div>
                </div>
                <div class="newtask">
                    <a href="{{ url('/workspace/isiform') }}">
                        <button class="btn btnnewtask"><i class="fa-solid fa-plus"></i><span
                                class="btn-text">New</span></button>
                    </a>
                </div>
                @forelse ($data_kelompok as $dk)
                    <div class="subject1">
                        <a href="workspace/overview/{{ $dk->id }}">
                            <button class="btn btnsubject1">
                                <div class="text1"></div>
                                <i class="fa-solid fa-ellipsis"></i>
                                <div class="fprbpl">{{ $dk->title }}</div>
                            </button>
                        </a>
                    </div>
                @empty
                    <div style="display: flex; justify-content: center; align-items: center; color: grey">There is no
                        task</div>
                @endforelse
            </div>
        </div>
    </div>
    </div>
    <script>
        function openPopup() {
            var overlay = document.getElementById("overlay");
            var popup = document.getElementById("popup");
            overlay.style.display = "block";
            popup.style.display = "block";
        }

        function closePopup() {
            var overlay = document.getElementById("overlay");
            var popup = document.getElementById("popup");
            overlay.style.display = "none";
            popup.style.display = "none";
        }
    </script>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
