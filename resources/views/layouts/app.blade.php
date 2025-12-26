<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Todo App') - Laravel 11</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('tasks.index') }}">📝 Todo App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse align-items-center justify-content-end" id="navbarNav">
                <button id="theme-toggle" class="btn btn-sm border ms-2">
                    <span id="moon-icon">@svg('heroicon-o-moon', 'w-5 h-5')</span>
                    <span id="sun-icon" style="display: none;">@svg('heroicon-o-sun', 'w-5 h-5')</span>
                </button>
            </div>
        </div>
    </nav>

    <main class="py-4" style="min-height: calc(100vh - 56px);">
        @yield('content')
    </main>

    <script>
        // Dark mode toggle
        const toggle = document.getElementById('theme-toggle');
        const moonIcon = document.getElementById('moon-icon');
        const sunIcon = document.getElementById('sun-icon');
        const html = document.documentElement;

        // Charger la préférence
        const currentTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-bs-theme', currentTheme);
        if (currentTheme === 'dark') {
            moonIcon.style.display = 'none';
            sunIcon.style.display = 'inline';
        }

        // Toggle
        toggle.addEventListener('click', () => {
            const newTheme = html.getAttribute('data-bs-theme') === 'light' ? 'dark' : 'light';
            html.setAttribute('data-bs-theme', newTheme);

            if (newTheme === 'dark') {
                moonIcon.style.display = 'none';
                sunIcon.style.display = 'inline';
            } else {
                moonIcon.style.display = 'inline';
                sunIcon.style.display = 'none';
            }

            localStorage.setItem('theme', newTheme);
        });
    </script>
</body>
</html>
