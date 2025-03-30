<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Store (Business)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="theme-business">
    <x-business.header />
    <div class="container mt-5">
        {{ $slot }}
    </div>
    <x-business.footer />
    @livewireScripts
</body>
</html>