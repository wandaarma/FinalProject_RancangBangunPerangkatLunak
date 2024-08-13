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

    <title>Progress</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/workspace/progress.css') }}">
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
    <div class="template2">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}">
            </div>
            <div class="home">
                <a href="{{ url('mytask') }}" type="button" class="btn hometext">Home</a>
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
            @foreach ($data_kelompok as $dk)
                <li class="nav-item">
                    <a href="{{ url('workspace/overview/' . $dk->id . '/') }}" class="nav-link">
                        <i class="fa-solid fa-book"></i>
                        Overview
                    </a>
                </li>
            @endforeach
            @foreach ($data_kelompok as $dk)
                <li class="nav-item">
                    <a href="{{ url('workspace/slashwork/' . $dk->id . '/') }}" class="nav-link">
                        <i class="fa-solid fa-shuffle"></i>
                        Slashwork
                    </a>
                </li>
            @endforeach
            @foreach ($data_kelompok as $dk)
                <li class="nav-item">
                    <a href="{{ url('workspace/merger/' . $dk->id . '/') }}" class="nav-link">
                        <i class="fa-solid fa-file"></i>
                        Merger
                    </a>
                </li>
            @endforeach
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="fa-solid fa-bars-progress"></i>
                    Progress
                </a>
            </li>
            <div class="linenav"></div>
        </div>

        <div class="main1">
            <div class="main2">
                <div class="progresskel">
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                @foreach ($data_kelompok as $dk)
                                    <p class="title">{{ $dk->title }}
                                        <button class="btn btn-link dropdown-toggle collapsed float-right"
                                            type="button" data-toggle="collapse" data-target="#subtaskContainer"
                                            aria-expanded="false" aria-controls="subtaskContainer"
                                            onclick="toggleSubtasks()"></button>
                                    </p>
                                @endforeach
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Progress:</h6>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" id="progressBar" role="progressbar"
                                        style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                    @foreach ($members as $member)
                                        <div class="card">
                                            <div class="card-body">
                                                <p id="memberName{{ $loop->index + 1 }}">{{ $member->member_name }}
                                                </p>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input subtask-checkbox"
                                                        id="subtask{{ $loop->index + 1 }}"
                                                        onchange="updateProgress()">
                                                    <label class="custom-control-label"
                                                        for="subtask{{ $loop->index + 1 }}">{{ $member->slash_subtask }}</label>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info"
                                                        id="subtaskProgress{{ $loop->index + 1 }}" role="progressbar"
                                                        aria-valuenow="{{ $member->progress }}" aria-valuemin="0"
                                                        aria-valuemax="100" style="width: {{ $member->progress }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function updateProgress() {
                    var progressBar = document.getElementById('progressBar');
                    var subtaskCheckboxes = document.getElementsByClassName('subtask-checkbox');
                    var totalSubtasks = subtaskCheckboxes.length;
                    var completedSubtasks = 0;
                    for (var i = 0; i < subtaskCheckboxes.length; i++) {
                        if (subtaskCheckboxes[i].checked) {
                            completedSubtasks++;
                        }
                    }
                    var percentage = (completedSubtasks / totalSubtasks) * 100;
                    progressBar.style.width = percentage + '%';
                    progressBar.setAttribute('aria-valuenow', percentage);
                    progressBar.innerHTML = percentage.toFixed(2) + '%';
                    for (var i = 0; i < subtaskCheckboxes.length; i++) {
                        var subtaskProgress = document.getElementById('subtaskProgress' + (i + 1));
                        var memberName = document.getElementById('memberName' + (i + 1));
                        var progress = subtaskCheckboxes[i].checked ? 100 : 0;
                        subtaskProgress.style.width = progress + '%';
                        subtaskProgress.setAttribute('aria-valuenow', progress);
                        subtaskProgress.innerHTML = progress + '%';
                        if (subtaskCheckboxes[i].checked) {
                            memberName.style.fontWeight = 'bold';
                        } else {
                            memberName.style.fontWeight = 'normal';
                        }
                    }
                }
            </script>
        </div>
    </div>

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
