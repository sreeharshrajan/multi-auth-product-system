<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="text-white bg-black flex items-center lg:justify-center min-h-screen flex-col">
    <div class="hero min-h-screen w-full relative">

        <!-- Background layer -->
        <div class="absolute inset-0 z-0"
            style="
                background:
                radial-gradient(circle at 50% 100%, rgba(70, 85, 110, 0.5) 0%, transparent 60%),
                radial-gradient(circle at 50% 100%, rgba(99, 102, 241, 0.4) 0%, transparent 70%),
                radial-gradient(circle at 50% 100%, rgba(181, 184, 208, 0.3) 0%, transparent 80%);
            ">
        </div>


        <!-- Content -->
        <div class="hero-content text-neutral-content text-center relative z-10">
            <div>
                <h1 class="mb-5 text-5xl font-bold">Product Management System</h1>
                <p class="mb-5 max-w-lg mx-auto">
                    This application demonstrates a production-ready Laravel architecture featuring
                    multi-authentication, large-scale queued product imports, and real-time user presence using
                    WebSockets.
                </p>
                <button class="btn btn-primary">Get Started</button>
            </div>
        </div>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>


</html>
