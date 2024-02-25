@extends('layouts.app')
@section('title', 'パスワード変更画面')
@section('content')
<a class="back_button" href="{{ route('user.profile') }}">←戻る</a>

<div class="password_change">
    <h1>パスワード変更</h1>
    <form action="{{ route('user.updatePassword') }}" method="POST" enctype="multipart/form-data">
        
        @csrf
        <div class="password_form">
            <label for="old_password">旧パスワード</label>
            <input type="password" class="password_control" id="old_password" name="old_password" >
            @error('old_password')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>
        <div class="password_form">
            <label for="new_password">新パスワード</label>
            <input type="password" class="password_control" id="new_password" name="new_password">
            @error('new_password')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>
        <div class="password_form">
            <label for="new_password_confirmation">新パスワード確認</label>
            <input type="password" class="new_password_control" id="new_password_confirmation" name="new_password_confirmation">
            @error('new_password_confirmation')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>


@endsection
