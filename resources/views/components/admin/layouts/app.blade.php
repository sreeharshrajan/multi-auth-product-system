<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @stack('styles')
</head>


<body class="min-h-screen font-sans antialiased">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Navbar -->
            <nav class="navbar w-full bg-base-300">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <!-- Sidebar toggle icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                        stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                        class="my-1.5 inline-block size-4">
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                        </path>
                        <path d="M9 4v16"></path>
                        <path d="M14 10l2 2l-2 2"></path>
                    </svg>
                </label>
                <div class="px-4 flex-1">{{ config('app.name', 'Multi-Auth Product System') }}</div>
                <div class="flex-none">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost">
                            <div>{{ Auth::guard('admin')->user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="#">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <a href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        Log Out
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-base-200/50 shadow">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-base-content leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page content here -->
            <main class="py-6 px-4 sm:px-6 lg:px-8 flex-grow">
                {{ $slot }}
            </main>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
                <!-- Sidebar content here -->
                <ul class="menu w-full grow">
                    <!-- List item -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Homepage">
                            <!-- Home icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                                stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                                class="my-1.5 inline-block size-4">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                <path
                                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                                </path>
                            </svg>
                            <span class="is-drawer-close:hidden">Homepage</span>
                        </a>
                    </li>

                    <!-- Products -->
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Products">
                            <!-- Products icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                                stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                                class="my-1.5 inline-block size-4">
                                <rect x="3" y="7" width="18" height="13" rx="2" />
                                <path d="M16 3v4M8 3v4M3 11h18" />
                            </svg>
                            <span class="is-drawer-close:hidden">Products</span>
                        </a>
                    </li>

                    {{-- Customers --}}
                    <li>
                        <a href="{{ route('admin.customers.index') }}"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Customers">
                            <!-- Customers icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                                stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                                class="my-1.5 inline-block size-4">
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M5.5 21h13a2.5 2.5 0 0 0-13 0z"></path>
                            </svg>
                            <span class="is-drawer-close:hidden">Customers</span>
                        </a>
                    </li>
                    <!-- List item -->
                    <li>
                        <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Settings">
                            <!-- Settings icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                                stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                                class="my-1.5 inline-block size-4">
                                <path d="M20 7h-9"></path>
                                <path d="M14 17H5"></path>
                                <circle cx="17" cy="17" r="3"></circle>
                                <circle cx="7" cy="7" r="3"></circle>
                            </svg>
                            <span class="is-drawer-close:hidden">Settings</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
