<<<<<<< HEAD
=======
<!-- layouts/app.blade.php -->
>>>>>>> cc6443323b6a17f90d73ecf8f6e77b5b2d6521b2
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <div class="header_1">
<<<<<<< HEAD
            <a href="{{ route('curriculum_edit') }}">授業管理</a>
            <a href="{{ route('article_edit') }}">お知らせ管理</a>
            <a href="{{ route('banner_edit') }}">バナー管理</a>
        </div>
        <div class="header_2">
            <a href="{{ route('login') }}">ログアウト</a>
=======
            <a href="{{ url('curriculum_edit') }}">授業管理</a>
            <a href="{{ url('article_edit') }}">お知らせ管理</a>
            <a href="{{ url('banner_edit') }}">バナー管理</a>
        </div>
        <div class="header_2">
            <a href="{{ url('login') }}">ログアウト</a>
>>>>>>> cc6443323b6a17f90d73ecf8f6e77b5b2d6521b2
        </div>
    </header>
        <a href='javascript:history.back()' class="back" >←戻る</a>
@yield('content')
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
