@extends('layouts.app')
@section('title', 'お知らせ一覧')
@section('content')
<a class="back_button" href="">←戻る</a>
<div class="article_list">
    <p>お知らせ一覧</p>
    <a href="{{ route('admin.createArticle') }}" class="article_create">新規作成</a>
    <table class="article_table">
        <thead>
            <tr>
                <th>投稿日時</th>
                <th>タイトル</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ \Carbon\Carbon::parse($article->posted_date)->format('Y月m月d日') }}</td>
                <td>{{ $article->title }}</td>
                <td>
                    <a href="{{ route('admin.editArticle', ['id' => $article->id]) }}" class="article_edit_btn">変更する</a>
                </td>
                <td>
                    <form action="{{ route('admin.deleteArticle', ['id' => $article->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="delete_btn" onclick='return confirm("削除しますか")'>削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
