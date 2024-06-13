<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/wonogiri.png') }}" type="image/x-icon">

    <title>{{ getPath() }}</title>

    @yield('style')
    <style>
        .checkbox:checked+.check-icon {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="sm:px-6 w-full">
        <div class="px-4 md:px-10 py-4 md:py-7">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard.index') }}">
                    <p class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800"
                        tabindex="0">
                        Akfititas Pengguna📈
                    </p>
                </a>
            </div>
        </div>
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <div class="sm:flex items-center justify-between">
                <div class="flex items-center">
                    <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800"
                        href="{{ route('user-monitoring.visits-monitoring') }}">
                        <div
                            class="py-2 px-8 text-indigo-700 rounded-full hover:text-indigo-700 hover:bg-indigo-100
                                {{ request()->routeIs('user-monitoring.visits-monitoring') ? 'bg-indigo-100' : '' }}">
                            <p>Visit Monitoring</p>
                        </div>
                    </a>
                    <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8"
                        href="{{ route('user-monitoring.actions-monitoring') }}">
                        <div
                            class="py-2 px-8 text-indigo-700 rounded-full hover:text-indigo-700 hover:bg-indigo-100
                                {{ request()->routeIs('user-monitoring.visits-monitoring') ? 'bg-indigo-100' : '' }}">
                            <p>Action Monitoring</p>
                        </div>
                    </a>
                    <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8"
                        href="{{ route('user-monitoring.authentications-monitoring') }}">
                        <div
                            class="py-2 px-8 text-indigo-700 rounded-full hover:text-indigo-700 hover:bg-indigo-100
                                {{ request()->routeIs('user-monitoring.visits-monitoring') ? 'bg-indigo-100' : '' }}">
                            <p>Authentication Monitoring</p>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('dashboard.index') }}"
                        class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0
                                    inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600
                                    focus:outline-none rounded items-center">
                        <p class="text-sm font-medium leading-none text-white mr-2">
                            Dashboard
                        </p>
                    </a>

                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>

</html>
