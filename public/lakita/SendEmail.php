<?php

$data = $_POST;
require_once("Rest_client/Rest_Client.php");
//require_once("SendSMS.php");

/*
 * *lấy giá khóa học từ api sang
 */

$config0 = array(
    'server' => 'http://api.lakita.vn/',
    'api_key' => 'RrF3rcmYdWQbviO5tuki3fdgfgr4',
    'api_name' => 'lakita-key',
);
$restClient0 = new Rest_Client($config0);
//$code_landing = 'http://'.$_SERVER['SERVER_NAME'];
$uri0 = "landingpage/price/" . $_SERVER['SERVER_NAME'];
$result0 = $restClient0->get($uri0);
$rs = json_decode($result0);


date_default_timezone_set("Asia/Ho_Chi_Minh");

$data = array(
    'name' => $data['name'],
    'phone' => $data['phone'],
    'email' => $data['email'],
    'address' => $data['dia_chi'],
    'code' => $rs->course_code,
    'name_course' => $rs->name,
    'price' => $rs->price,
    'price_root' => $rs->price_root,
    'date' => date("d/m/Y")
);

//if (!SendSMS($data['phone'], $data['code'])) {
//    // Thông báo về server
//}

function Send($info = array()) {

    $email = isset($info['email']) ? $info['email'] : '';

    if (empty($email)) {
        echo 'Lỗi email.';
        return false;
    }

    if ($email == "NO_PARAM@gmail.com") {
        echo 'Email mặc định! ' . $email;
        return false;
    }

    $phone = isset($info['phone']) ? $info['phone'] : '';
    $name = isset($info['name']) ? $info['name'] : 'Quý khách';
    $address = isset($info['address']) ? $info['address'] : '(Chờ xác nhận)';
    $code = isset($info['code']) ? $info['code'] : '';
    $course_name = isset($info['name_course']) ? $info['name_course'] : '';
    $price = isset($info['price']) ? $info['price'] : '';
    $price_root = isset($info['price_root']) ? $info['price_root'] : '';
    $date = isset($info['date']) ? $info['date'] : '';

    $subject = "Lakita.vn Thông tin khóa học đã đăng ký.";

    $content = '<ul style="list-style:none;padding:0px"><li style="margin-bottom:20px;color:#272727"><span style="font-weight:bold">' . $name . '</span> thân mến,</li><li style="margin-bottom:20px;color:#272727"><span style="font-size:16px">C</span>ảm ơn bạn đã đăng ký khóa học trên <a href="https://lakita.vn/" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNEbLp-K8kACMsrP_j85e5oYR9c_8A">Lakita.vn</a>. Dưới đây là thông tin về các khóa học bạn đã đăng ký:</li></ul><table cellpadding="0" cellspacing="0"><tbody><tr><td width="600" align="center" style="border:1px solid #00b8e3;border-radius:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:20px 0px 10px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr style="text-align:left"><td width="300" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><span style="font-weight:bold">Thông tin đơn hàng</span></td></tr></tbody></table></td></tr></tbody></table></td><td width="300"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px;color:#272727">' . $date . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding:0px 0px 10px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr style="text-align:left"><td width="300" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><span style="font-weight:bold;color:#272727">Họ tên người mua:</span></td></tr></tbody></table></td></tr></tbody></table></td><td width="300"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px;color:#272727">' . $name . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding:0px 0px 10px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr style="text-align:left"><td width="300" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><span style="font-weight:bold;color:#272727">Địa chỉ giao hàng</span></td></tr></tbody></table></td></tr></tbody></table></td><td width="300"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px;color:#272727">' . $address .'</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding:0px 0px 10px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr style="text-align:left"><td width="300" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><span style="font-weight:bold;color:#272727">Số điện thoại:</span></td></tr></tbody></table></td></tr></tbody></table></td><td width="300"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px;color:#272727">' . $phone . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding:0px 0px 20px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr style="text-align:left"><td width="300" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><span style="font-weight:bold;color:#272727">Phương thức thanh toán:</span></td></tr></tbody></table></td></tr></tbody></table></td><td width="300"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 20px;color:#272727">Giao mã kích hoạt và thu tiền tận nơi (COD)</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style="width:100%"><tbody><tr style="background:#41a85f"><td style="padding:15px 10px 15px 10px;color:white">Khóa học</td><td style="padding:15px 10px 15px 10px;color:white">Đơn giá</td><td style="padding:15px 10px 15px 10px;color:white">Giảm giá</td><td style="padding:15px 10px 15px 10px;color:white">Tổng tạm</td></tr><tr style="background:#f7f7f7"><td style="padding:10px 10px">' . $course_name .'</td><td style="padding:10px 10px">' . $price_root . '&nbsp;₫</td><td style="padding:10px 10px">' . ((int)$price_root - (int)$price) . '&nbsp;₫</td><td style="padding:10px 10px;text-align:right">' . $price .'&nbsp;₫</td></tr><tr style="background:#f0f0f0"><td style="padding:10px 10px;color:#272727"></td><td style="padding:10px 10px;color:#272727">Tổng tạm</td><td style="padding:10px 10px;color:#272727;text-align:right" colspan="2">' . $price .' ₫</td></tr><tr style="background:#f0f0f0"><td style="padding:10px 10px"></td><td style="padding:10px 10px;color:#272727">Phí vận chuyển</td><td style="padding:10px 10px;color:#272727;text-align:right" colspan="2">0 ₫</td></tr><tr style="background:#f0f0f0"><td style="padding:10px 10px"></td><td style="padding:10px 10px;color:#272727;font-weight:bold">Tổng cộng</td><td style="padding:10px 10px;color:#272727;text-align:right;font-weight:bold" colspan="2">' . $price .'&nbsp;₫</td></tr><tr><td>&nbsp;</td></tr></tbody></table>';

    $message = '<div><table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:Tahoma,Arial;background-color:#f0f0f0" width="100%"><tbody><tr><td><table style="width:100%;line-height:20px"><tbody><tr><td style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important"><div><table style="width:100%"><tbody><tr><td><img src="https://lakita.vn/styles/logo1.png" style="height:50px" class="CToWUd"></td><td align="right"><ul style="list-style:none"><li style="margin-bottom:5px"><a href="tel:1900.6364.09" style="text-decoration:blink;color:#272727" target="_blank">Hotline <span style="font-weight:bold;display:inline-block">1900.6361.95</span></a></li><li><a href="mailto:cskh@lakita.vn" style="text-decoration:blink;color:#272727" target="_blank">Email <span style="color:#41a85f;font-weight:bold">cskh@lakita.vn</span></a></li></ul></td></tr></tbody></table></div></td></tr></tbody></table><table style="width:100%;line-height:20px"><tbody><tr><td bgcolor="#41a85f" style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important"><div><table cellpadding="0" cellspacing="0" style="width:100%"><tbody><tr><td><table cellpadding="0" cellspacing="0" style="width:100%"><tbody><tr><td align="center" style="padding:12px;font-size:13px"><a href="https://lakita.vn/" style="text-decoration:none;color:white" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNG3djygD9aJADUXewb6P4Ri7sVCnQ">Nổi bật</a></td><td align="center" style="padding:12px;font-size:13px"><a href="https://lakita.vn/nhom-khoa-hoc/nang-cao-nang-luc-van-phong-11.html" style="text-decoration:none;color:white" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/nhom-khoa-hoc/nang-cao-nang-luc-van-phong-11.html&source=gmail&ust=1500609481608000&usg=AFQjCNETy5fo-zD72CchdcOm8NS2KNJTwg">Nâng cao năng lực văn phòng</a></td><td align="center" style="padding:12px;font-size:13px"><a href="https://lakita.vn/nhom-khoa-hoc/ke-toan-21.html" style="text-decoration:none;color:white" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/nhom-khoa-hoc/ke-toan-21.html&source=gmail&ust=1500609481608000&usg=AFQjCNECXxr7WysC9OoolayTujVuA67GDg">Kế toán</a></td><td align="center" style="padding:12px;font-size:13px"><a href="https://lakita.vn/nhom-khoa-hoc/hanh-chinh-22.html" style="text-decoration:none;color:white" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/nhom-khoa-hoc/hanh-chinh-22.html&source=gmail&ust=1500609481608000&usg=AFQjCNHUh1kuD578BijQo6Q6Xzr_TbZlEg">Hành chính</a></td><td align="center" style="padding:12px;font-size:13px"><a href="https://lakita.vn/nhom-khoa-hoc/nhan-su-23.html" style="text-decoration:none;color:white" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/nhom-khoa-hoc/nhan-su-23.html&source=gmail&ust=1500609481608000&usg=AFQjCNFiDGh8fljSd0CocSz6flALpBPakA">Nhân sự</a></td><td align="center" style="padding:12px;font-size:13px;border-right:none"><a href="https://lakita.vn/nhom-khoa-hoc/cong-nghe-thong-tin-13.html" style="text-decoration:none;color:white" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/nhom-khoa-hoc/cong-nghe-thong-tin-13.html&source=gmail&ust=1500609481608000&usg=AFQjCNFcjZw8c3ENQ6W20sdihYnZQkQqmQ">CNTT</a></td></tr></tbody></table></td></tr></tbody></table></div></td></tr></tbody></table><table style="margin: auto;"><tbody><tr><td bgcolor="white" style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important"><div><table><tbody><tr><td style="padding:0px 20px"><h2 style="color:#41a85f;font-size:26px;text-align:center;font-weight:bold;padding:20px 0px;margin-bottom:0px;line-height:40px">Cảm ơn bạn đã đăng ký khóa học trên <a href="https://lakita.vn/" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNEbLp-K8kACMsrP_j85e5oYR9c_8A">Lakita.vn</a></h2><span style="display:block"><img src="https://lakita.vn/styles/images/email/cover-mail.png" style="margin:0px auto;display:inherit" class="CToWUd"></span><div>' . $content . '<p>Đơn đăng ký khóa học của bạn đang được xử lý. <a href="https://lakita.vn/" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNEbLp-K8kACMsrP_j85e5oYR9c_8A">Lakita.vn</a> sẽ tiến hành giao mã kích hoạt cho bạn. Sau khi nhận mã và thanh toán, để bắt đầu học, bạn thao tác theo các bước sau:</p><table cellpadding="0" cellspacing="0"><tbody><tr><td width="600" align="center"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:20px 0px 0px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr><td width="150" align="center" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 0px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><img src="https://lakita.vn/styles/images/email/step1.png" style="display:block" class="CToWUd"></td></tr></tbody></table></td></tr></tbody></table></td><td width="450" align="center"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 0px"><p><span style="font-weight:bold;color:#41a85f;display:block">Bước 1:</span>Truy cập <a href="https://lakita.vn/" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNEbLp-K8kACMsrP_j85e5oYR9c_8A">Lakita.vn</a> và đăng nhập tài khoản <span style="font-weight:bold;color:#41a85f">lakita</span> của bạn. Sau đó, vào menu <span style="font-weight:bold">Khóa học của tôi</span> ở góc trái trên thanh menu, bạn chọn Kích hoạt khóa học.</p></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding:20px 0px 20px 0px;font-size:14px"><table cellpadding="0" cellspacing="0"><tbody><tr><td width="150" align="center" style="margin-bottom:5px"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 0px"><table cellpadding="0" cellspacing="0"><tbody><tr><td><img src="https://lakita.vn/styles/images/email/step2.png" style="display:block" class="CToWUd"></td></tr></tbody></table></td></tr></tbody></table></td><td width="450" align="center"><table cellpadding="0" cellspacing="0"><tbody><tr><td style="padding:0px 10px 0px 0px"><p><span style="font-weight:bold;color:#41a85f;display:block">Bước 2:</span>Để bắt đầu học, bạn vào mục <a href="http:///trang-ca-nhan/khoa-hoc" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=http:///trang-ca-nhan/khoa-hoc&source=gmail&ust=1500609481608000&usg=AFQjCNEYEUXu7VqDLO5piRVIPyDBVHFtog">Khóa học của tôi</a> và click chọn nút <span style="font-weight:bold">Vào học ngay</span> ở khóa học muốn tham gia.</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><p style="color:#272727"><span style="font-size:16px">N</span>ếu bạn cần hỗ trợ hoặc tư vấn thêm thông tin, hãy liên hệ với <a href="https://lakita.vn/" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNEbLp-K8kACMsrP_j85e5oYR9c_8A">Lakita.vn</a> qua email <span><a href="mailto:cskh@lakita.vn" style="color:#41a85f;font-weight:bold;text-decoration:none" target="_blank">cskh@Lakita.vn</a></span> hoặc số điện thoại <span style="font-weight: bold;">1900.6361.95</span>.</p><hr><ul style="padding:none;list-style:none;padding:0px;list-style:none;text-align:center;line-height:25px;color:#272727"><li><a href="https://lakita.vn/" style="font-weight:bold;color:#41a85f;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn/&source=gmail&ust=1500609481608000&usg=AFQjCNEbLp-K8kACMsrP_j85e5oYR9c_8A">Lakita.vn</a> | Cùng bạn vươn xa</li><li>Văn phòng: 701 CT1 skylight 125D Minh Khai, Hai Bà Trưng, Hà Nội</li></ul><div><ul style="padding:0px;text-align:center"><li style="display:inline-block"><a href="https://www.facebook.com/groups/congdonghocvienlakita/" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://www.facebook.com/lakita.vn&source=gmail&ust=1500609481608000&usg=AFQjCNF_TpVxyJ-VCgSD-VZ2w-f_cRX8Gw"><img src="https://ci5.googleusercontent.com/proxy/I3knLNchzQ59uXZ5xDnwwqfmWJbfazWeyVDnW0HanNRnEJJMW3e9FY7NRmB7KK0Qnw2cJTKtyQyY=s0-d-e1-ft#https://lakita.vn/img/mail/icon-f.png" class="CToWUd"></a></li><li style="display:inline-block"><a href="https://www.youtube.com/user/lakitavn" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://www.youtube.com/user/lakitavn&source=gmail&ust=1500609481608000&usg=AFQjCNGn1-Dw0bVAdJxyRxPjRVKdS3f0Sg"><img src="https://ci6.googleusercontent.com/proxy/IYy-N-QqewI4v32OQxfDRvO4bFxTGVC8T0v-xi3Dd0WXSNnw2W0wLunjmIsM9eo3FZmkQMlv_8vk=s0-d-e1-ft#https://lakita.vn/img/mail/icon-y.png" class="CToWUd"></a></li></ul></div></div></td></tr></tbody></table></div></td></tr></tbody></table><table style="width:100%;line-height:20px"><tbody><tr><td style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important"><div><p style="text-align:center;color:#272727">Trong trường hợp bạn quên mật khẩu, vui lòng click vào <a href="https://lakita.vn" style="font-weight:bold; color: #41a85f; text-decoration: none;" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=vi&q=https://lakita.vn&source=gmail&ust=1500609481608000&usg=AFQjCNEkjP1CWexUMNyw6dBybhLwbS3ppw">đây</a> để lấy lại mật khẩu mới<br/>Mức giá, thông tin sản phẩm và các khuyến mãi trong email này là chính xác tại thời điểm gởi mail, tuy nhiên chúng có giới hạn thời gian và có thể thay đổi.</p></div></td></tr></tbody></table></td></tr></tbody></table></div>';

    /*
     * Mẫu gửi mail dùng php mailer
     */
    include('PHPMailer/class.smtp.php');
    include "PHPMailer/class.phpmailer.php"; 
    $nFrom = "Công ty cổ phần giáo dục Lakita";    //mail duoc gui tu dau, thuong de ten cong ty ban
    $mFrom = 'cskh@lakita.vn';  //dia chi email cua ban 
    $mPass = 'lakita.com.vn';       //mat khau email cua ban
    $nTo = $name; //Ten nguoi nhan
    $mTo = $email;   //dia chi nhan mail
    $mail             = new PHPMailer();
    $body             = $message;
    $title = $subject;   //Tieu de gui mail
    $mail->IsSMTP();             
    $mail->CharSet  = "utf-8";
    $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";    // sever gui mail.
    $mail->Port       = 465;         // cong gui mail de nguyen
    // xong phan cau hinh bat dau phan gui mail
    $mail->Username   = $mFrom;  // khai bao dia chi email
    $mail->Password   = $mPass;              // khai bao mat khau
    $mail->SetFrom($mFrom, $nFrom);
    $mail->AddReplyTo('cskh@lakita.vn', 'Lakita.vn'); //khi nguoi dung phan hoi se duoc gui den email nay
    $mail->Subject    = $title;// tieu de email 
    $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
    $mail->AddAddress($mTo, $nTo);
    // thuc thi lenh gui mail 
    if(!$mail->Send()) {
        echo 'Co loi!';
         
    } else {
         
        echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
    }

}
Send($data);
   