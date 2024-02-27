@extends('layouts/admin_layout')

@section('content')
<div class="container">
    <div class="top">
        <div>
            <p>ユーザーネーム：{{ $admin->name }}</p>
            <p>メールアドレス：{{ $admin->email }}</p>
        </div>
    </div>
</div>
@endsection