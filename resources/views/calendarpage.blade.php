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

    <title>Calendar</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/calendar.css') }}">
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/f92c007b9c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
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
                    <a class="dropdown-item" href="#">Item 1</a>
                    <a class="dropdown-item" href="#">Item 2</a>
                    <a class="dropdown-item" href="#">Item 3</a>
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
            <li class="nav-item">
                <a href="{{ url('workspace') }}" class="nav-link">
                    <i class="fa-solid fa-list-check"></i>
                    Workspace
                </a>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link active">
                    <i class="fa-regular fa-calendar"></i>
                    Calendar
                </a>
            </li>
            <div class="linenav"></div>
            <li class="nav-item">
                <a href="" class="nav-link">
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-link float-left" id="prevMonthBtn">&lt;</button>
                                <h5 class="text-center" id="currentMonth"></h5>
                                <button class="btn btn-link float-right" id="nextMonthBtn">&gt;</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered small-calendar">
                                    <thead>
                                        <tr>
                                            <th>S</th>
                                            <th>M</th>
                                            <th>T</th>
                                            <th>W</th>
                                            <th>T</th>
                                            <th>F</th>
                                            <th>S</th>
                                        </tr>
                                    </thead>
                                    <tbody id="smallCalendarBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h5 id="detailedMonthYear" class="text-center"></h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered detailed-calendar" id="detailedCalendarHeader">
                                    <thead>
                                        <tr>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailedCalendarBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // Daftar nama bulan
                    var months = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];
                    var currentDate = new Date();
                    var currentMonth = currentDate.getMonth();
                    var currentYear = currentDate.getFullYear();
                    // Definisikan variabel colors di bawah ini
                    var colors = [];
                    // Mengisi small calendar
                    function fillSmallCalendar(month, year) {
                        var firstDay = new Date(year, month, 1);
                        var lastDay = new Date(year, month + 1, 0);
                        var startingDay = firstDay.getDay();
                        var totalDays = lastDay.getDate();
                        var stoday = new Date();
                        var date = 1;
                        var smallCalendarBody = $("#smallCalendarBody");
                        smallCalendarBody.empty();
                        for (var row = 0; row < 6; row++) {
                            var newRow = $("<tr></tr>");
                            for (var col = 0; col < 7; col++) {
                                if (row === 0 && col < startingDay) {
                                    // Kolom kosong sebelum tanggal pertama bulan
                                    newRow.append('<td></td>');
                                } else if (date > totalDays) {
                                    // Kolom kosong setelah tanggal terakhir bulan
                                    newRow.append('<td></td>');
                                } else {
                                    // Kolom dengan tanggal bulan ini
                                    if (month === stoday.getMonth() && year === stoday.getFullYear() && date === stoday
                                        .getDate()) {
                                        newRow.append('<td class="stoday">' + date + '</td>');
                                    } else {
                                        newRow.append('<td>' + date + '</td>');
                                    }
                                    date++;
                                }
                            }
                            newRow.appendTo(smallCalendarBody);
                        }
                    }

                    // Mengisi detailed calendar
                    function fillDetailedCalendar(month, year) {
                        $("#detailedMonthYear").text(months[month] + ' ' + year);
                        var firstDay = new Date(year, month, 1);
                        var lastDay = new Date(year, month + 1, 0);
                        var startingDay = firstDay.getDay();
                        var totalDays = lastDay.getDate();
                        var currentDate = new Date();
                        var currentDay = currentDate.getDate();
                        var date = 1;
                        var detailedCalendarBody = $("#detailedCalendarBody");
                        detailedCalendarBody.empty();
                        for (var row = 0; row < 6; row++) {
                            var newRow = $("<tr></tr>");
                            for (var col = 0; col < 7; col++) {
                                if (row === 0 && col < startingDay) {
                                    // Kolom kosong sebelum tanggal pertama bulan
                                    newRow.append('<td></td>');
                                } else if (date > totalDays) {
                                    // Kolom kosong setelah tanggal terakhir bulan
                                    newRow.append('<td></td>');
                                } else {
                                    // Kolom dengan tanggal bulan ini
                                    var cell = $('<td>' + date + '</td>');
                                    if (date === currentDay && month === currentDate.getMonth() && year === currentDate
                                        .getFullYear()) {
                                        cell.addClass('today'); // Menambahkan kelas 'today' untuk memberikan gaya tampilan
                                    }
                                    newRow.append(cell);
                                    date++;
                                }
                            }
                            newRow.appendTo(detailedCalendarBody);
                        }

                        // Tambahkan penambahan warna pada tanggal-tanggal dengan deadlines
                        @foreach ($deadlinesindividu as $dli)
                            var deadlineDate = new Date("{{ $dli->deadline }}");
                            var deadlineDay = deadlineDate.getDate();
                            var deadlineMonth = deadlineDate.getMonth();
                            var deadlineYear = deadlineDate.getFullYear();
                            if (deadlineMonth === month && deadlineYear === year) {
                                detailedCalendarBody.find('td:contains(' + deadlineDay + ')').css('background-color',
                                    'rgba(255, 236, 217, 0.8)');
                                var title = "{{ $dli->title }}"; // Tambahkan ini untuk mengakses label
                                var tdElement = detailedCalendarBody.find('td:contains(' + deadlineDay + ')');
                                tdElement.append('<div>' + title +
                                    '</div>'); // Tambahkan elemen div untuk menampilkan label di bawah tanggal
                            }
                        @endforeach
                        @foreach ($deadlineskelompok as $dlk)
                            var deadlineDate = new Date("{{ $dlk->deadline }}");
                            var deadlineDay = deadlineDate.getDate();
                            var deadlineMonth = deadlineDate.getMonth();
                            var deadlineYear = deadlineDate.getFullYear();
                            if (deadlineMonth === month && deadlineYear === year) {
                                detailedCalendarBody.find('td:contains(' + deadlineDay + ')').css('background-color',
                                    'rgba(255, 236, 217, 0.8)');
                                var title = "{{ $dlk->title }}"; // Tambahkan ini untuk mengakses label
                                var tdElement = detailedCalendarBody.find('td:contains(' + deadlineDay + ')');
                                tdElement.append('<div>' + title +
                                    '</div>'); // Tambahkan elemen div untuk menampilkan label di bawah tanggal
                            }
                        @endforeach
                    }

                    // Mengisi small calendar dan detailed calendar awal
                    fillSmallCalendar(currentMonth, currentYear);
                    fillDetailedCalendar(currentMonth, currentYear);

                    // Tombol untuk mengganti bulan sebelumnya
                    $("#prevMonthBtn").click(function() {
                        if (currentMonth === 0) {
                            currentMonth = 11;
                            currentYear--;
                        } else {
                            currentMonth--;
                        }
                        fillSmallCalendar(currentMonth, currentYear);
                        fillDetailedCalendar(currentMonth, currentYear);
                    });

                    // Tombol untuk mengganti bulan berikutnya
                    $("#nextMonthBtn").click(function() {
                        if (currentMonth === 11) {
                            currentMonth = 0;
                            currentYear++;
                        } else {
                            currentMonth++;
                        }
                        fillSmallCalendar(currentMonth, currentYear);
                        fillDetailedCalendar(currentMonth, currentYear);
                    });
                });
            </script>
        </div>
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
