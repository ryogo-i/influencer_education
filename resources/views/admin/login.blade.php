@extends('layouts.guest_layout')

@section('content')

<header>
    <a href="{{ route('showRegistrationForm') }}" class="register">新規会員登録はこちら</a>
</header>
<div class="container">
    <h1>管理画面ログイン</h1>
    <div class="login">
    
        <form action="{{route('admin.login')}}" method="post">
            @csrf
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        @if(session('login_success'))
        <div class="alert alert-success">
        {{ session('login_success') }}
        </div>
        @endif
        </div>
        @endif
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password">
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>

    @endsection