$(document).ready(function() {
    //消去ボタン
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var bannerId = form.find('.banner-id').val(); // 修正: 'product-id' を 'banner-id' に変更
        var confirmation = window.confirm("ID:" + bannerId + "を消去しますか？");

        if (confirmation) {
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    // 削除成功時の処理
                    form.closest('li').remove();
                    alert('バナーを削除しました。');
                },
                error: function(error) {
                    console.error(error);
                    window.alert('エラーが発生しました。');
                }
            });
        }
    });

    //既存の画像更新
    $('.input-image').on('change', function() {
        $(this).next('.update-btn').show();
    });

    $('.banner-update-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('バナーが更新されました。');
                location.reload();
            },
            error: function(error) {
                console.error(error);
                alert('エラーが発生しました。');
            }
        });
    });

    //画像新規登録
    $('#bannerForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
    
        $.ajax({
            url: $(this).data('create-route'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('バナーが新規登録されました。');
                    location.reload();
            },
            error: function(error) {
                console.error(error);
                alert('エラーが発生しました。');
            }
        });
    });
});