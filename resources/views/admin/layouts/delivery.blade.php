@extends('admin.layouts.app')

@section('title', '配信日時編集')

@section('content')
    <h1>配信日時編集</h1>

    <form action="{{ route('delivery.update', $curriculum->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div id="delivery-time-container">
        @forelse ($deliveryTimes as $deliveryTime)
            <div class="delivery-time-item">
                <div class="form-group">
                    <label for="delivery_from">配信開始日時</label>
                    <input type="datetime-local" name="delivery_from[]" value="{{ \Carbon\Carbon::parse($deliveryTime->delivery_from)->format('Y-m-d\TH:i') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="delivery_to">配信終了日時</label>
                    <input type="datetime-local" name="delivery_to[]" value="{{ \Carbon\Carbon::parse($deliveryTime->delivery_to)->format('Y-m-d\TH:i') }}" class="form-control">
                </div>

                <button type="button" class="btn btn-de remove-delivery-time">&#x2212;</button>
            </div>
        </div>
        @empty
        <div class="delivery-time-item">
                    <div class="form-group">
                        <label for="delivery_from">配信開始日時</label>
                        <input type="datetime-local" name="delivery_from[]" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="delivery_to">配信終了日時</label>
                        <input type="datetime-local" name="delivery_to[]" class="form-control">
                    </div>

                    <button type="button" class="btn btn-de remove-delivery-time">&#x2212;</button>
                </div>
            @endforelse
        </div>

        <button type="button" class="btn btn-success" id="add-delivery-time">&#x2b;</button>

        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
@endsection
