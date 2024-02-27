@extends('layouts.guest_layout')

@section('content')
<header>
    <a href="{{ route('admin.showAdminLogin') }}" class="register">ログインはこちら</a>
</header>
<div class="container">
    <h1>管理画面ログイン</h1>
    <div class="login">
        <form action="{{route('register')}}" method="post">
            @csrf
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <label for="name">ユーザーネーム</label>
            <input type="text" id="name" name="name">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password">
            <label for="password">パスワード確認</label>
            <input type="password" id="inputPasswordConfirmation" name="password_confirmation">
            <div>
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection