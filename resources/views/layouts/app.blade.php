<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ config('app.url') }}">
    <meta name="path" content="{{ config('ledger.path') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js', 'vendor/ledger') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'vendor/ledger') }}" rel="stylesheet">
</head>
<style>

</style>
<body>
    <div id="app" class="flex">

        <side-nav></side-nav>

        <div class="flex flex-col flex-grow p-8 mt-10 md:mt-0">

            <div class="flex flex-row justify-between mb-3">
                <a class="text-white font-bold text-3xl inline-block" href="{{ route('ledger.dashboard') }}">Ledger</a>
                <div class="text-white font-bold text-3xl">$10,000</div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 p-4 rounded text-green-600 mb-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 p-4 rounded text-red-600 mb-3">{{ session('error') }}</div>
            @endif
            
            @yield('content')
        </div>
    </div>
</body>
</html>