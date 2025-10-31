<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Shop' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="holy-grail">
        <!-- Galvene -->
        <header class="header">
            <h1>🛒 Testa Logo</h1>
        </header>

        <!-- Kreisā sānjosla / navigācija -->
        <nav class="nav">
            <ul>
                <li><a href="/">Sākums</a></li>
                <li><a href="{{ route('products.index') }}">Produkti</a></li>
                <li><a href="#">Par mums</a></li>
            </ul>
        </nav>

        <!-- Galvenā sadaļa -->
        <main class="main">
            <h6>flash:</h6>
            <x-flash-success />
        <x-flash-errors />
            {{ $slot }}
        </main>

        <!-- Labā sānjosla / reklāmas -->
        <aside class="aside">
            <h2>Reklāmas</h2>
            <p>Šeit var būt testa reklāmas teksts vai baneri.</p>
        </aside>

        <!-- Kājene -->
        <footer class="footer">
            <p>&copy; 2025 Testa Copyright</p>
        </footer>
    </div>
</body>
</html>
