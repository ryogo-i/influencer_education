<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <div class="header_left">
            <a href="">時間割</a>
            <a href="">授業進捗</a>
            <a href="">プロフィール設定</a>
        </div>
        <div class="header_right">
            <a href="">ログアウト</a>
        </div>
   </header>

    @yield('content')
</body>
</html>