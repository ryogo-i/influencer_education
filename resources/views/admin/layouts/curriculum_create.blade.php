@extends('admin.layouts.app')

@section('title', '授業設定')

@section('content')
<h2>授業設定</h2>

<form action="{{ route('curriculum.store') }}" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf

    <div class="form-image-container">
        <div class="image-container">
            <img id="image-preview" src="#" alt="Image Preview">
        </div>
        <div class="file-input-container">
            <label for="thumbnail">サムネイル画像</label>
            <input type="file" id="thumbnail" name="thumbnail">
        </div>
    </div>

    
    <div class="form-container">
        <div class="form-group">
            <label for="grades_id">学年</label>
            <select id="grades_id" name="grades_id" class="form-control">
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title" class="label">授業名</label>
            <input type="text" id="title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="video_url" class="label">動画URL</label>
            <input type="text" id="video_url" name="video_url"" class="form-control">
        </div>
        <div class="form-group">
            <label for="description" class="label">授業概要</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="always_delivery_flg">常時公開</label>
            <input type="checkbox" id="always_delivery_flg" name="always_delivery_flg">
        </div>
    </div>

    
    <h2>配信日時追加</h2>

    <div id="delivery-time-container">
        <div class="form-group">
            <label for="delivery_from">配信開始日時</label>
            <input type="datetime-local" id="delivery_from" name="delivery_from[]" class="form-control">
        </div>

        <div class="form-group">
            <label for="delivery_to">配信終了日時</label>
            <input type="datetime-local" id="delivery_to" name="delivery_to[]" class="form-control">
        </div>
    </div>

    <button type="button" class="btn btn-success" id="add-delivery-time">&#x2b;</button>

    <div class="button-container">
        <button type="submit" class="btn btn-primary">登録</button>
    </div>
</form>
@endsection