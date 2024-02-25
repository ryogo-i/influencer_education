@extends('layouts.app')
@section('title', 'お知らせ新規作成')
@section('content')
<a class="back_button" href="{{ route('article.list') }}">←戻る</a>
<div class="article">
    <h1>お知らせ変更</h1>

    <form action="{{ route('admin.storeArticle') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="article_form">
            <label for="posted_date">投稿日時</label>
            <input type="datetime-local" class="form-control" id="posted_date" name="posted_date" value=''>
            @error('posted_date')
            <p class="error_message">投稿日時を入力してください。</p>
            @enderror
        </div>
        <div class="article_form">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value=''>
            @error('title')
            <p class="error_message">タイトルを255文字以内で入力してください。</p>
            @enderror
        </div>
        <div class="article_form">
            <label for="article_contents">本文</label>
            <textarea type="text" class="form-control" id="article_contents" name="article_contents" value=''></textarea>
            @error('article_contents')
            <p class="error_message">本文を入力してください。</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" onclick='return confirm("お知らせを作成しますか")'>登録</button>
    </form>
</div>
@endsection
