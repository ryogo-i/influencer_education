<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
    <title>Top</title>
</head>

<body>
    <main class="main">
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
