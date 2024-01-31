document.addEventListener("DOMContentLoaded", function () {

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
        // 前の年の12月に移動する場合
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear -= 1;
        }
        // 次の年の1月に移動する場合
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
});