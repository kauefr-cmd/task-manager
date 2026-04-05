<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            const saved = localStorage.getItem('theme') || 'system';
            const system = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            document.getElementById('html-root')?.setAttribute('data-theme', saved === 'system' ? system : saved);
        })();
    </script>
</head>
<body class="bg-base-200 min-h-screen">

    <div class="navbar bg-base-100 shadow-sm px-4">
        <div class="flex-1">
            <a href="{{ route('welcome') }}" class="btn btn-ghost text-xl font-bold">
                Task Manager
            </a>
        </div>
        <div class="flex-none gap-2">
            <div class="dropdown dropdown-end">
                <button tabindex="0" id="theme-toggle" class="btn btn-ghost btn-sm gap-1">
                    <span id="theme-icon"></span>
                    <span id="theme-label" class="text-xs"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-60" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box shadow-lg border border-base-300 w-44 p-1 mt-1 z-50">
                    <li>
                        <button onclick="setTheme('light')" id="opt-light" class="flex items-center gap-2">
                            ☀️ <span>Claro</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="setTheme('dark')" id="opt-dark" class="flex items-center gap-2">
                            🌙 <span>Escuro</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="setTheme('system')" id="opt-system" class="flex items-center gap-2">
                            💻 <span id="opt-system-label">Sistema</span>
                        </button>
                    </li>
                </ul>
            </div>
            <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">Tarefas</a>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">+ Nova Tarefa</a>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8 max-w-5xl">

        @if(session('success'))
            <div class="alert alert-success mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')

    </main>

    <script>
        const ICONS  = { light: '☀️', dark: '🌙', system: '💻' };
        const LABELS = { light: 'Claro', dark: 'Escuro', system: 'Sistema' };

        function systemPreference() {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        function setTheme(theme) {
            const resolved = theme === 'system' ? systemPreference() : theme;
            document.getElementById('html-root').setAttribute('data-theme', resolved);
            document.getElementById('theme-icon').textContent = ICONS[theme];

            const systemSuffix = theme === 'system' ? ` (${LABELS[systemPreference()]})` : '';
            document.getElementById('theme-label').textContent = LABELS[theme] + systemSuffix;
            document.getElementById('opt-system-label').textContent = 'Sistema' + (theme !== 'system' ? ` (${LABELS[systemPreference()]})` : '');

            ['light', 'dark', 'system'].forEach(t => {
                document.getElementById('opt-' + t)?.classList.toggle('active', t === theme);
            });

            localStorage.setItem('theme', theme);

            document.activeElement?.blur();
        }

        setTheme(localStorage.getItem('theme') || 'system');

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
            if (localStorage.getItem('theme') === 'system') setTheme('system');
        });
    </script>
</body>
</html>
