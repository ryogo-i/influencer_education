let currentClassId = "{{ $currentClassId }}";

function handleNavLinkClick(e) {
    e.preventDefault();
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    this.classList.add('active');
    currentClassId = this.getAttribute('data-class-id');
    console.log('クラスID:', currentClassId);
    let className = $(this).text();
    $('#currentClassName').text(className);
    console.log('表示クラス', className);
    changeMonth(0, currentClassId);
}


document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', handleNavLinkClick);
});


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
    let activeLink = document.querySelector('.nav-link.active');
    let currentClassId;

    if (activeLink) {
        currentClassId = activeLink.getAttribute('data-class-id');
    } else {
        currentClassId = "{{ $currentClassId }}"; //初期動作
    }

    let classId = currentClassId;
    console.log('クラスを絞ります。クラス', classId);
    if (!activeLink) {
        console.warn('現在のクラスIDを使用します。');
        currentClassId = document.getElementById('currentClassName').getAttribute('data-current-class-id');
        classId = currentClassId;
    } else {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        // クリックされたリンクにactiveを追加
        activeLink.classList.add('active');
        console.log('activeLink:', activeLink);
    }

    currentMonth += monthChange;

    if (currentMonth < 1) {
        currentMonth = 12;
        currentYear -= 1;
    }
    if (currentMonth > 12) {
        currentMonth = 1;
        currentYear += 1;
    }
    if (currentMonth === 4) {
        $('#prevMonth').hide();
        console.log('前月hide');
    } else if (currentMonth === 3) {
        $('#nextMonth').hide();
        console.log('次月hide');
    } else {
        $('#prevMonth').show();
        $('#nextMonth').show();
    }
    const url = `/authenticated/schedule?month=${currentYear}-${currentMonth}&class_id=${classId}`;

    fetch(url, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
        .then(response => response.text())
        .then(data => {
            console.log('フェッチ成功');
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, 'text/html');
            const newSchedulesContainer = doc.getElementById('schedules_container');
            const currentSchedulesContainer = document.getElementById('schedules_container');
            currentSchedulesContainer.innerHTML = '';
            currentSchedulesContainer.appendChild(newSchedulesContainer);
            console.log("現在のクラス：", classId);

            const newDisplayMonth = currentMonth;
            $('#displayMonth').text(currentYear + "年" + newDisplayMonth + "月スケジュール");

            console.log('フェッチ完了');
        })
        .catch(error => {
            console.error('フェッチエラー:', error);
        });
}