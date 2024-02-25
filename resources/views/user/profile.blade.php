@extends('layouts.app')
@section('title', 'プロフィール変更画面')
@section('content')
<a class="back_button" href="">←戻る</a>
@if(session('success'))
    <div class="alert alert_success">
        {{ session('success') }}
    </div>
@endif

<div class="profile">
    <h1>プロフィール変更</h1>
    <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="profile_image">
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" id="image">
            @else
                <img src="{{ asset('images/no-image.png') }}" alt="プロフィール画像" id="image">
            @endif
            <div>
                <p>プロフィール画像</p>
                <input type="file" class="img_path" id="img_path" name="img_path" onchange="previewImage(this);">
            </div>
        </div>
        <div class="profile_form">
            <label for="name">ユーザーネーム</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            @error('name')
            <p class="error_message">ユーザーネームは必須です。</p>
            @enderror
        </div>
        <div class="profile_form">
            <label for="name_kana">カナ</label>
            <input type="text" class="form-control" id="name_kana" name="name_kana" value="{{ $user->name_kana }}">
            @error('name_kana')
            <p class="error_message">カナは必須です。</p>
            @enderror
        </div>
        <div class="profile_form">
            <label for="email">メールアドレス</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
            @error('email')
            <p class="error_message">メールアドレスは必須です。</p>
            @enderror
        </div>
        <div class="profile_form">
            <label for="password">パスワード</label>
            <a href="{{ route('user.password') }}">パスワードを変更する</a>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


@endsection
