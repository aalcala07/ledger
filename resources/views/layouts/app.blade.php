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
    <div id="app" class="flex flex-col p-8">

        <div class="flex flex-row justify-between mb-3">
            <a class="text-white font-bold text-3xl inline-block" href="{{ route('ledger.dashboard') }}">Ledger</a>
            <div class="text-white font-bold text-3xl">$10,000</div>
        </div>
        
        @yield('content')
    </div>
</body>
</html>