@extends('layouts.app')
@section('title', 'お知らせ')
@section('content')
<a class="back_button" href="{{ route('user.top') }}">←戻る</a>

<div class="article">
    <div class="posted_date">
        <p>{{ \Carbon\Carbon::parse($article->posted_date)->format('Y月m月d日') }}</p> 
    </div>
    <div class="title">
        <p>{{ $article->title }}</p>
    </div>
    <div class="article_contents">
        <p>{{ $article->article_contents }}</p>
    </div>
</div>
@endsection
