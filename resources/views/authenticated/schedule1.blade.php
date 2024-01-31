@extends('layouts.user_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Schedule</h1>
        <div class="time_schedule">
            <div class="card-header">これは時間割です。</div>
            <div class="card-body">
                <div class="text-center">
                    <p>
                        <button id="prevMonth">◀</button>
                        {{ $displayMonth->format('Y年n月') }}スケジュール
                        <button id="nextMonth">▶</button>
                    </p>
                    <p>{{ $currentClassName }}</p>
                </div>
            </div>
            <div id="schedules_container">
                @foreach ($filteredCurriculums as $curriculum)
                <div class="schedules_column">
                    @if ($curriculum->thumbnail)
                    <img src="{{ $curriculum->thumbnail }}" alt="授業サムネイル">
                    @else
                    No image
                    @endif
                    <p>{{ $curriculum->title }}</p>
                    <ul>
                        @foreach ($curriculum->filteredDeliveryTimes as $deliveryTime)
                        <li class="detail">{{ $deliveryTime->delivery_from }}~{{ $deliveryTime->delivery_to }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // BladeからのルートをJavaScript変数にセット
    const showScheduleUrl = "{{ route('showSchedule') }}";
</script>
<script src="{{ asset('js/schedule.js') }}"></script>
@endpush