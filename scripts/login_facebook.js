// Only run if this page is loaded completely
$( document ).ready(function() {
    $('#login').click(function() {
        const username = $('#user').val();
        const password = $('#pass').val();
        var login_type = $('#login_type').val();

        if (login_type !== 1 && login_type !== 2) {
            login_type = 1;
        }

        if (username === '' || password === '') {
            showErrorMsg(422, 'Thiếu tên đăng nhập hoặc mật khẩu!');
        } else {
            $.ajax({
                url: 'cookie/get_cookie.php',
                type: "post",
                dataType: "json",
                data: {
                    u: username,
                    p: password,
                    t: login_type
                },
                success: function (result) {

                    console.log(result);
                    const data = result;

                    var error_code = data['error_code'];
                    if (typeof error_code === 'undefined') {
                        // Success
                        const cookie = data['session_cookies'][1]['value'];
                        const fr = data['session_cookies'][2]['value'];
                        const id = data['uid'];
                        const dat = data['session_cookies'][3]['value'];

                        showSuccessMsg();

                        $('#cookie1').val('xs=' + cookie + ';c_user=' + id + ';fr=' + fr + ';datr=' + dat);

                    } else {
                        // Failed
                        error_code = parseInt(error_code);
                        if (error_code === 400) {
                            showErrorMsg(error_code, 'Tên đăng nhập không tồn tại!');
                        } else if (error_code === 401) {
                            showErrorMsg(error_code, 'Sai mật khẩu!');
                        }
                        else if (error_code === '405') {
                            showErrorMsg(405, 'Vừa bị checkpoint mất rồi, thử lại sau nhé!');
                        } else {
                            showErrorMsg(error_code, 'Lỗi không xác định, chụp màn hình lại và báo admin nhé ^^');
                        }
                    }
                }
            });
        }
    });
});

function showErrorMsg(code, msg) {
    $('#login_result').html('<div class="alert alert-danger fade in alert-dismissable" style="margin-top:18px;">\n' +
        '    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>\n' +
        '    <strong>Lỗi ' + code + '!</strong> ' + msg +  '\n' +
        '</div>\n')
}

function showSuccessMsg() {
    $('#login_result').html('<div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">\n' +
        '    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>\n' +
        '    <strong>Thành công!</strong> Hãy nhấn đăng nhập ngay nào!\n' +
        '</div>\n')
}