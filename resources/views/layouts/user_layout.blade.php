<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link href="{{ asset('css/test_user.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <header>
            <nav class="pc-nav">
                <ul class="nav-ul">
                    <li class="nav-item">
                        <a>時間割</a>
                    </li>
                    <li class="nav-item">
                        <a>授業進捗</a>
                    </li>
                    <li class="nav-item">
                        <a>プロフィール設定</a>
                    </li>
                    <li class="nav-item">
                        <a>ログアウト</a>
                    </li>
                </ul>
            </nav>
        </header>

        <aside>
            <div class="sidebar">
                <a href="/authenticated/schedule" class="btn btn-secondary">← 戻る</a>
                <ul class="nav flex-column">
                    @foreach($classes as $class_all)
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-class-id="{{ $class_all->id }}">
                            {{ $class_all->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <main class="main">
            @yield('content')
        </main>

        @stack('scripts')
    </div>
</body>

</html>