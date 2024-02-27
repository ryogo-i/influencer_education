@extends('layouts.user_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="time_schedule">

            <div class="card-body">
                <div class="text-center">
                    <button id="prevMonth">◀</button>
                    <p id="displayMonth">
                        {{ $displayMonth->format('Y年n月') }}スケジュール
                    </p>
                    <button id="nextMonth">▶</button>
                    <p class="now_class" id="currentClassName" data-current-class-id="{{ $currentClassId }}">{{
                        $currentClassName }}</p>
                </div>
            </div>

            <div id="schedules_container" class="schedules_container">

                @foreach ($filteredCurriculums as $curriculum)
                <div class="schedules_column">
                    @if ($curriculum->thumbnail)
                    <img src="{{ $curriculum->thumbnail }}" alt="授業サムネイル">
                    @endif
                    <p>{{ $curriculum->title }}</p>
                    <ul>
                        @foreach ($curriculum->filteredDeliveryTimes as $deliveryTime)
                        <li class="detail">{{ Carbon\Carbon::parse($deliveryTime->delivery_from)->format('n月j日 H:i') }}
                            ~
                            {{ Carbon\Carbon::parse($deliveryTime->delivery_to)->format('H:i') }}</li>
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
<script src="{{ asset('js/schedule.js') }}"></script>
@endpush