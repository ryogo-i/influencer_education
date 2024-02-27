@extends('layouts/admin_layout')

@section('content')
<div class="container">
    <h1>バナー管理</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul>
                    @foreach ($banners as $banner)
                        <li class="imageTag">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image" class="image">
                            <div class="file">
                                <form class="banner-update-form" action="{{ route('banner.update', ['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="bannerImage" accept="image/*" class="input-image" required>
                                    <button type="submit" class="update-btn" style="display: none;">更新</button>
                                </form>
                                <form action="{{ route('banner.delete', ['id' => $banner->id]) }}" method="POST"
                                class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" class="banner-id" value="{{ $banner->id }}">
                                    <button type="submit" class="delete-btn" id="delete">ー</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <form id="bannerForm" enctype="multipart/form-data" data-create-route="{{ route('banner.create') }}">
            @csrf
                <div class="form-group">
                    <label for="bannerImage" class="create-btn">＋</label>
                    <input type="file" class="form-control" id="bannerImage" name="bannerImage" accept="image/*" required style="display: none;">
                </div>
                <button type="submit" class="banner_create">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/banner.js') }}"></script>
@endpush