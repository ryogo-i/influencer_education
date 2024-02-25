@extends('layouts.app')
@section('title', 'お知らせ変更')
@section('content')
<a class="back_button" href="{{ route('article.list') }}">←戻る</a>
<div class="article">
    <h1>お知らせ変更</h1>
    <form action="{{ route('admin.updateArticle', ['id' => $article->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $article->id }}">
        <div class="article_form">
            <label for="posted_date">投稿日時</label>
            <input type="text" class="form-control" id="posted_date" name="posted_date" value='{{ \Carbon\Carbon::parse($article->posted_date)->format('Y-m-d') }}'>
            @error('posted_date')
            <p class="error_message">投稿日時を入力してください</p>
            @enderror
        </div>
        <div class="article_form">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value='{{ $article->title }}'>
            @error('title')
            <p class="error_message">タイトルを255文字以内で入力してください。</p>
            @enderror
        </div>
        <div class="article_form">
            <label for="article_contents">本文</label>
            <textarea class="form-control" id="article_contents" name="article_contents">{{ $article->article_contents }}</textarea>
            @error('article_contents')
            <p class="error_message">本文を入力してください。</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" onclick='return confirm("お知らせを変更しますか")'>登録</button>
    </form>
</div>
@endsection
