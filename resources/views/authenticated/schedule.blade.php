<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
    <aside>
        <div class="sidebar">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">← 戻る</a>
            <ul class="nav flex-column">
                @foreach($class as $class_all)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('showSchedule', ['class_id' => $class_all->id]) }}">
                        {{ $class_all->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>

    <p>
        <button id="prevMonth">◀</button>
        {{ $displayMonth->format('Y年n月') }}スケジュール
        <button id="nextMonth">▶</button>
    </p>
    <p>{{ $currentClassName }}</p>

    <div id="schedules_container">
        @foreach ($filteredCurriculums as $curriculum)
        <div class="schedules_column">
            @if ($curriculum->thumbnail)
            <img src="{{ $curriculum->thumbnail }}" alt="授業サムネイル">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const showScheduleUrl = "{{ route('showSchedule') }}";


        let currentDate = new Date();
        let currentMonth = currentDate.getMonth() + 1;
        let currentYear = currentDate.getFullYear();

        document.getElementById('prevMonth').addEventListener('click', function (e) {
            e.preventDefault();
            changeMonth(-1);
            console.log('前月クリック');
        });

        document.getElementById('nextMonth').addEventListener('click', function (e) {
            e.preventDefault();
            changeMonth(1);
            console.log('次月クリック');
        });

        // 月の変更処理
        function changeMonth(monthChange) {
            console.log('changeMonth');
            currentMonth += monthChange;

            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear -= 1;
            }
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear += 1;
            }
            const url = `/authenticated/schedule?month=${currentYear}-${currentMonth}`;

            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.text())
                .then(data => {
                    console.log('フェッチ成功');
                    document.getElementById('schedules_container').innerHTML = '';
                    console.log('フェッチ消去');
                    document.getElementById('schedules_container').innerHTML = data;
                    console.log('フェッチ完了');
                })
                .catch(error => {
                    console.error('フェッチエラー:', error);
                });
        }
    </script>
</body>

</html>