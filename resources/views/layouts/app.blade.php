<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Könyvtár')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <h1>📚 Könyvtár</h1>
    <nav>
        <a href="{{ route('books.index') }}">Books</a>
        <a href="{{ route('writers.index') }}">Authors</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
