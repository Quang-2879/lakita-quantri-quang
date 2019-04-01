
$(document).ready(function () {
    function ajax() {
        $.ajax({
            url: 'lakita/save_c2.php',
            type: 'POST',
            data: $('#fr_save_c2').serialize(),
            success: function (data) {

            },
            error: function () {

            },
            complete: function () {

            }
        });
        return false;
    }
    
    ajax();

    $(document).on("submit", ".e_form_submit", function (e) {
         e.preventDefault();
       
        var obj = $(this);
        check_lienhe(obj);
        confirm = false;
    });
});
function submit_c2(obj) {
    var url = obj.attr("action");
    obj.ajaxSubmit({
        type: "POST",
        url: url,
        dataType: 'json',
        async: false,
        success: function (data) {
            if (data.status) {
                alert("Thông tin của bạn đã được lưu!\n Chúng tôi sẽ liên lạc với bạn sớm nhất có thể!");
            } else {
                location.reload();
            }
        },
        error: function () {
        },
        complete: function () {
        }
    });
}

function check_sdt(sdt) {
    if (isNaN(sdt.value)) {
        sdt.style.border = '3px solid Yellow';
        sdt.value = '';
        alert("Số điện thoại có dạng 09XXXXXXXX hoac 012XXXXXXXX");
    }
}

function validateEmail(email) {
    var re = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm;
    return re.test(email);
}

function validatePhone(tel) {
    var re = /^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/;
    return re.test(tel);
}

function check_lienhe(obj) {
    var button = obj.find('.e_btn_submit');
    var email = obj.find('input[name="email"]').val();
    var name = obj.find('input[name="name"]').val();
    var phone = obj.find('input[name="phone"]').val();

    if ((name.trim() == "") || (name == "Họ tên *")) {
        alert("Vui lòng nhập họ và tên của bạn");
        obj.find('input[name="name"]').focus();
        return (false);
    }
    
    if (!validateEmail(email)) {
        alert("Vui lòng nhập đúng email của bạn");
        obj.find('input[name="email"]').focus();
        return (false);
    }

    if (!validatePhone(phone)) {
        alert("Vui lòng nhập đúng số Điện thoại");
        obj.find('input[name="phone"]').focus();
        return (false);
    }

    button.attr('disabled', 'disabled');
    var url = obj.attr("action");
    
    $.ajax({
        type: "POST",
        url: url,
        data: obj.serialize(),
        beforeSend: function () {
            $(".popup-wrapper").show();
        },
        success: function (data1) {
            $.ajax({
                url: 'lakita/SendEmail.php',
                type: "POST",
                data: obj.serialize(),
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log('Không gửi được Email!');
                },
                complete: function (data) {
                    window.location.assign('popup_dangky.html');
                }
            });
        },
        error: function (data1) {
            alert('Lỗi không đăng ký được. Bạn vui lòng đăng ký lại!');
        },
        complete: function (data1) {

        }
    });
}