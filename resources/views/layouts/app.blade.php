<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamPlus Onboarding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">StreamPlus</a>
</nav>

<main class="py-4">
    @yield('content')
</main>
</body>
</html>
