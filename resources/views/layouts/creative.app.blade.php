<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Store (Creative)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="theme-creative">
    <x-creative.header />
    <div class="container mt-5">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>