<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('css/test_admin.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div id="app">
        <!-- Header -->
        <header>
            <nav class="pc-nav">
                <ul class="nav-ul">
                    <li class="nav-item">
                        <a class="nav-link" href="">授業管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">お知らせ管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.banner_management')}}">バナー管理</a>
                    </li>
                    <li class="logout">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                    </li>
                </ul>
                                
            </nav>
        </header>

        <aside>
            @if(!request()->is('admin/dashboard'))
            <div class="sidebar">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                    {{ config('admin.dashboard', '←戻る') }}
                </a>
            </div>
            @endif
        </aside>

        <!-- Main Content -->
        <main class="main">
            @yield('content')
        </main>
        @stack('scripts')
    </div>
</body>

</html>