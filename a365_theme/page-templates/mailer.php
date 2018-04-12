<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Mailer
 *
 * @package A356
 */
?>
<?php

function sendMailASQ() {
    // parse serialized string
    $fields;
    parse_str($_POST['field'], $fields);

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    // $mail->Username = "a365@ccihp.org";
    // $mail->Password = "smartcare";
    $mail->Username = "support.a365@ccihp.org";
    $mail->Password = "Smartcare2015";
    $mail->SetFrom("support.a365@ccihp.org", "A365");
    $mail->Subject = "=?UTF-8?B?".base64_encode("[A365] Kết quả bài sàng lọc ASQ®")."?=";
    $mail->IsHTML(true);
    $mail->MsgHTML( $fields['content'].'<br>'.
    '
    <table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
    <tbody>
    <tr>
    <td align="center"><center>
    <table style="margin-left:auto;margin-right:auto;width:600px;text-align:center" border="0" width="600" cellspacing="0" cellpadding="30">
    <tbody>
    <tr>
    <td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p><strong>BẠN ĐÃ HOÀN THÀNH BÀI SÀNG LỌC ASQ®!</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5" valign="top">
    <h4 style="color:#2db5e5!important">1.THÔNG TIN BÀI&nbsp;SÀNG LỌC</h4>
    <p style="margin:0.5em 0">Tên bài ASQ®: <strong>Bài ASQ® '.$_SESSION['asq_set'].' tháng tuổi</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <h4 style="color:#2db5e5!important">2.THÔNG TIN TRẺ</h4>
    <p style="margin:0.5em 0">Tên trẻ: <strong>'.$_SESSION['current_child']->name.'</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p style="font-style:italic"></p><br> Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</p>
    <p>Cảm ơn bạn đã lựa chọn A365 để đồng hành và phát triển cùng con !.<br> Trân trọng!</p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5;font-size:smaller">
    <table style="width:100%">
    <tbody>
    <tr>
    <td style="text-align:left;vertical-align:top">
    <p><span style="color:#8a2121"><strong>TRUNG TÂM SÁNG KIẾN VÀ SỨC KHỎE DÂN SỐ</strong></span></p>
    <p>Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
    <p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
    </td>
    <td style="text-align:right;vertical-align:top">
    <p>&nbsp;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </center></td>
    </tr>
    </tbody>
    </table>
    ');//$fields['content'];
    $mail->CharSet="UTF-8";
    $mail->AddAddress($fields['email']);
    //$data = base64_decode($_POST['data']);
    $source = $_POST['source'];
    include("vendor/mpdf/mpdf/mpdf.php");
    $c = array(
        // mode: 'c' for core fonts only, 'utf8-s' for subset etc.
        'mode' => 'utf8',
        // page format: 'A0' - 'A10', if suffixed with '-L', force landscape
        'format' => 'A4',
         // default font size in points (pt)
        'font_size' => 1,
        // default font
        'font' => 'Arial',
        // page margins in mm
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0
	);
    $source = urldecode($source);
    $mpdf = new mPDF($c['mode'], $c['format'], $c['font_size'], $c['font']);
    $stylesheet = file_get_contents(get_template_directory_uri()."/css/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($source, 2);
    $emailAttachment = $mpdf->Output('','S');
    //$emailAttachment = chunk_split(base64_encode($emailAttachment));
    //$mpdf->Output('/Users/duongquangvu/A365/a365_theme/filename.pdf','F');
    $filename = $_POST['testname'];
    $mail->AddStringAttachment($emailAttachment, $filename, 'base64', 'application/pdf');
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
};

function sendMailMchatR() {
    // parse serialized string
    $fields;
    parse_str($_POST['field'], $fields);

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    // $mail->Username = "a365@ccihp.org";
    // $mail->Password = "smartcare";
    $mail->Username = "support.a365@ccihp.org";
    $mail->Password = "Smartcare2015";
    $mail->SetFrom("support.a365@ccihp.org", "A365");
    $mail->Subject = "=?UTF-8?B?".base64_encode("[A365] Kết quả bài sàng lọc M-CHAT-R")."?=";
    $mail->Body = $fields['content'].'<br>'.
    '<table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
    <tbody>
    <tr>
    <td align="center"><center>
    <table style="margin-left:auto;margin-right:auto;width:600px;text-align:center" border="0" width="600" cellspacing="0" cellpadding="30">
    <tbody>
    <tr>
    <td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p><strong>BẠN ĐÃ HOÀN THÀNH BÀI SÀNG LỌC M-CHAT-R!</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <h4 style="color:#2db5e5!important">THÔNG TIN TRẺ</h4>
    <p style="margin:0.5em 0">Tên trẻ: <strong>'.$_SESSION['current_child']->name.'</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p style="font-style:italic"></p><br> Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</p>
    <p>Cảm ơn bạn đã lựa chọn A365 để đồng hành và phát triển cùng con !.<br> Trân trọng!</p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5;font-size:smaller">
    <table style="width:100%">
    <tbody>
    <tr>
    <td style="text-align:left;vertical-align:top">
    <p><span style="color:#8a2121"><strong>TRUNG TÂM SÁNG KIẾN VÀ SỨC KHỎE DÂN SỐ</strong></span></p>
    <p>Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
    <p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
    </td>
    <td style="text-align:right;vertical-align:top">
    <p>&nbsp;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </center></td>
    </tr>
    </tbody>
    </table>

    ';//$fields['content'];
    $mail->CharSet="UTF-8";
    $mail->AddAddress($fields['email']);
    //$data = base64_decode($_POST['data']);
    $source = $_POST['source'];

    include("vendor/mpdf/mpdf/mpdf.php");
    $c = array(
        // mode: 'c' for core fonts only, 'utf8-s' for subset etc.
        'mode' => 'utf8',
        // page format: 'A0' - 'A10', if suffixed with '-L', force landscape
        'format' => 'A4',
         // default font size in points (pt)
        'font_size' => 1,
        // default font
        'font' => 'Arial',
        // page margins in mm
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0
    );
    $source = urldecode($source);
    $mpdf = new mPDF($c['mode'], $c['format'], $c['font_size'], $c['font']);
    $stylesheet = file_get_contents(get_template_directory_uri()."/css/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($source, 2);
    $emailAttachment = $mpdf->Output('','S');
    //$emailAttachment = chunk_split(base64_encode($emailAttachment));
    //$mpdf->Output('/Users/duongquangvu/A365/a365_theme/filename.pdf','F');
    $filename = $_POST['testname'];
    $mail->AddStringAttachment($emailAttachment, $filename, 'base64', 'application/pdf');
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
};

function sendMailMchatRF() {
    // parse serialized string
    $fields;
    parse_str($_POST['field'], $fields);

    $mail->Subject = "[A365] Kết quả bài sàng lọc M-CHAT-R/F";
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    // $mail->Username = "a365@ccihp.org";
    // $mail->Password = "smartcare";
    $mail->Username = "support.a365@ccihp.org";
    $mail->Password = "Smartcare2015";
    $mail->SetFrom("support.a365@ccihp.org", "A365");
    $mail->Subject = "=?UTF-8?B?".base64_encode("[A365] Kết quả bài sàng lọc M-CHAT-R/F")."?=";
    $mail->Body = $fields['content'].'<br>'.
    '<table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
    <tbody>
    <tr>
    <td align="center"><center>
    <table style="margin-left:auto;margin-right:auto;width:600px;text-align:center" border="0" width="600" cellspacing="0" cellpadding="30">
    <tbody>
    <tr>
    <td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p><strong>BẠN ĐÃ HOÀN THÀNH BÀI SÀNG LỌC M-CHAT-R/F!</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <h4 style="color:#2db5e5!important">THÔNG TIN TRẺ</h4>
    <p style="margin:0.5em 0">Tên trẻ: <strong>'.$_SESSION['current_child']->name.'</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p style="font-style:italic"></p><br> Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</p>
    <p>Cảm ơn bạn đã lựa chọn A365 để đồng hành và phát triển cùng con !.<br> Trân trọng!</p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5;font-size:smaller">
    <table style="width:100%">
    <tbody>
    <tr>
    <td style="text-align:left;vertical-align:top">
    <p><span style="color:#8a2121"><strong>TRUNG TÂM SÁNG KIẾN VÀ SỨC KHỎE DÂN SỐ</strong></span></p>
    <p>Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
    <p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
    </td>
    <td style="text-align:right;vertical-align:top">
    <p>&nbsp;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </center></td>
    </tr>
    </tbody>
    </table>

    ';//$fields['content'];
    $mail->CharSet="UTF-8";
    $mail->AddAddress($fields['email']);
    //$data = base64_decode($_POST['data']);
    $source = $_POST['source'];

    include("vendor/mpdf/mpdf/mpdf.php");
    $c = array(
        // mode: 'c' for core fonts only, 'utf8-s' for subset etc.
        'mode' => 'utf8',
        // page format: 'A0' - 'A10', if suffixed with '-L', force landscape
        'format' => 'A4',
         // default font size in points (pt)
        'font_size' => 1,
        // default font
        'font' => 'Arial',
        // page margins in mm
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0
    );
    $source = urldecode($source);
    $mpdf = new mPDF($c['mode'], $c['format'], $c['font_size'], $c['font']);
    $stylesheet = file_get_contents(get_template_directory_uri()."/css/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($source, 2);
    $emailAttachment = $mpdf->Output('','S');
    //$emailAttachment = chunk_split(base64_encode($emailAttachment));
    //$mpdf->Output('/Users/duongquangvu/A365/a365_theme/filename.pdf','F');
    $filename = $_POST['testname'];
    $mail->AddStringAttachment($emailAttachment, $filename, 'base64', 'application/pdf');
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
};

function sendMailQOL() {
    // parse serialized string
    $fields;
    parse_str($_POST['field'], $fields);

    $mail->Subject = "[A365] Kết quả bài khảo sát QOL";
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    // $mail->Username = "a365@ccihp.org";
    // $mail->Password = "smartcare";
    $mail->Username = "support.a365@ccihp.org";
    $mail->Password = "Smartcare2015";
    $mail->SetFrom("support.a365@ccihp.org", "A365");
    $mail->Subject = "=?UTF-8?B?".base64_encode("[A365] Kết quả bài khảo sát QOL")."?=";
    $mail->Body = $fields['content'].'<br>'.
    '<table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
    <tbody>
    <tr>
    <td align="center"><center>
    <table style="margin-left:auto;margin-right:auto;width:600px;text-align:center" border="0" width="600" cellspacing="0" cellpadding="30">
    <tbody>
    <tr>
    <td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p><strong>BẠN ĐÃ HOÀN THÀNH BÀI KHẢO SÁT QOL!</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <h4 style="color:#2db5e5!important">THÔNG TIN BÀI KHẢO SÁT</h4>
    <p style="margin:0.5em 0">Tên bài: <strong>Khảo sát chất lượng cuộc sống cha mẹ</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p style="font-style:italic"></p><br> Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</p>
    <p>Cảm ơn bạn đã lựa chọn A365 để đồng hành và phát triển cùng con !.<br> Trân trọng!</p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5;font-size:smaller">
    <table style="width:100%">
    <tbody>
    <tr>
    <td style="text-align:left;vertical-align:top">
    <p><span style="color:#8a2121"><strong>TRUNG TÂM SÁNG KIẾN VÀ SỨC KHỎE DÂN SỐ</strong></span></p>
    <p>Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
    <p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
    </td>
    <td style="text-align:right;vertical-align:top">
    <p>&nbsp;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </center></td>
    </tr>
    </tbody>
    </table>

    ';//$fields['content'];
    $mail->CharSet="UTF-8";
    $mail->AddAddress($fields['email']);
    //$data = base64_decode($_POST['data']);
    $source = $_POST['source'];

    include("vendor/mpdf/mpdf/mpdf.php");
    $c = array(
        // mode: 'c' for core fonts only, 'utf8-s' for subset etc.
        'mode' => 'utf8',
        // page format: 'A0' - 'A10', if suffixed with '-L', force landscape
        'format' => 'A4',
         // default font size in points (pt)
        'font_size' => 1,
        // default font
        'font' => 'Arial',
        // page margins in mm
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0
    );
    $source = urldecode($source);
    $mpdf = new mPDF($c['mode'], $c['format'], $c['font_size'], $c['font']);
    $stylesheet = file_get_contents(get_template_directory_uri()."/css/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($source, 2);
    $emailAttachment = $mpdf->Output('','S');
    //$emailAttachment = chunk_split(base64_encode($emailAttachment));
    //$mpdf->Output('/Users/duongquangvu/A365/a365_theme/filename.pdf','F');
    $filename = $_POST['testname'];
    $mail->AddStringAttachment($emailAttachment, $filename, 'base64', 'application/pdf');
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
};

function sendMailTheoDoi() {
    // parse serialized string
    $fields;
    parse_str($_POST['field'], $fields);

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    // $mail->Username = "a365@ccihp.org";
    // $mail->Password = "smartcare";
    // $mail->SetFrom("a365@ccihp.org", "A365");
    $mail->Username = "support.a365@ccihp.org";
    $mail->Password = "Smartcare2015";
    $mail->SetFrom("support.a365@ccihp.org", "A365");
    $mail->Subject = "=?UTF-8?B?".base64_encode("[A365] Kết quả bài Theo dõi hiệu quả can thiệp")."?=";
    $mail->Body = $fields['content'].'<br>'.
    '<table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
    <tbody>
    <tr>
    <td align="center"><center>
    <table style="margin-left:auto;margin-right:auto;width:600px;text-align:center" border="0" width="600" cellspacing="0" cellpadding="30">
    <tbody>
    <tr>
    <td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p><strong>BẠN ĐÃ HOÀN THÀNH BÀI THEO DÕI HIỆU QUẢ CAN THIỆP!</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <h4 style="color:#2db5e5!important">THÔNG TIN BÀI KHẢO SÁT</h4>
    <p style="margin:0.5em 0">Tên bài: <strong>THEO DÕI HIỆU QUẢ CAN THIỆP</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p style="font-style:italic"></p><br> Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</p>
    <p>Cảm ơn bạn đã lựa chọn A365 để đồng hành và phát triển cùng con !.<br> Trân trọng!</p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5;font-size:smaller">
    <table style="width:100%">
    <tbody>
    <tr>
    <td style="text-align:left;vertical-align:top">
    <p><span style="color:#8a2121"><strong>TRUNG TÂM SÁNG KIẾN VÀ SỨC KHỎE DÂN SỐ</strong></span></p>
    <p>Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
    <p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
    </td>
    <td style="text-align:right;vertical-align:top">
    <p>&nbsp;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </center></td>
    </tr>
    </tbody>
    </table>

    ';//$fields['content'];
    $mail->CharSet="UTF-8";
    $mail->AddAddress($fields['email']);
    //$data = base64_decode($_POST['data']);
    $source = $_POST['source'];

    include("vendor/mpdf/mpdf/mpdf.php");
    $c = array(
        // mode: 'c' for core fonts only, 'utf8-s' for subset etc.
        'mode' => 'utf8',
        // page format: 'A0' - 'A10', if suffixed with '-L', force landscape
        'format' => 'A4',
         // default font size in points (pt)
        'font_size' => 1,
        // default font
        'font' => 'Arial',
        // page margins in mm
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0
    );
    $source = urldecode($source);
    $mpdf = new mPDF($c['mode'], $c['format'], $c['font_size'], $c['font']);
    $stylesheet = file_get_contents(get_template_directory_uri()."/css/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($source, 2);
    $emailAttachment = $mpdf->Output('','S');
    //$emailAttachment = chunk_split(base64_encode($emailAttachment));
    //$mpdf->Output('/Users/duongquangvu/A365/a365_theme/filename.pdf','F');
    $filename = $_POST['testname'];
    $mail->AddStringAttachment($emailAttachment, $filename, 'base64', 'application/pdf');
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
};

function sendMailATEC() {
    // parse serialized string
    $fields;
    parse_str($_POST['field'], $fields);

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    // $mail->Username = "a365@ccihp.org";
    // $mail->Password = "smartcare";
    // $mail->SetFrom("a365@ccihp.org", "A365");
    $mail->Username = "support.a365@ccihp.org";
    $mail->Password = "Smartcare2015";
    $mail->SetFrom("support.a365@ccihp.org", "A365");
    $mail->Subject = "=?UTF-8?B?".base64_encode("[A365] Kết quả bài khảo sát ATEC")."?=";
    $mail->Body = $fields['content'].'<br>'.
    '<table style="background:#f4f7f9" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f7f9">
    <tbody>
    <tr>
    <td align="center"><center>
    <table style="margin-left:auto;margin-right:auto;width:600px;text-align:center" border="0" width="600" cellspacing="0" cellpadding="30">
    <tbody>
    <tr>
    <td style="background:#ffffff;border:1px solid #dce1e5" align="left" valign="top" width="">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
    <td><img src="'.get_template_directory_uri() . '/images/logo.png'.'" alt="" width="200" height="86" class="CToWUd"></td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p><strong>BẠN ĐÃ HOÀN THÀNH BÀI KHẢO SÁT ATEC!</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <h4 style="color:#2db5e5!important">THÔNG TIN BÀI KHẢO SÁT</h4>
    <p style="margin:0.5em 0">Tên bài: <strong>Đánh giá tổng thể tình trạng của trẻ (ATEC)</strong></p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5">
    <p style="font-style:italic"></p><br> Nếu có bất kỳ thắc mắc nào liên quan tới việc sử dụng, bạn vui lòng liên hệ với email <span style="text-decoration:underline;color:#0000ff"><a href="mailto:support.a365@ccihp.org" target="_blank">support.a365@ccihp.org</a></span> hoặc số điện thoại 0985.220.391 để được giải đáp.</p>
    <p>Cảm ơn bạn đã lựa chọn A365 để đồng hành và phát triển cùng con !.<br> Trân trọng!</p>
    </td>
    </tr>
    <tr>
    <td style="border-top:1px solid #dce1e5;font-size:smaller">
    <table style="width:100%">
    <tbody>
    <tr>
    <td style="text-align:left;vertical-align:top">
    <p><span style="color:#8a2121"><strong>TRUNG TÂM SÁNG KIẾN VÀ SỨC KHỎE DÂN SỐ</strong></span></p>
    <p>Số 48 Tổ 39 Ngõ 251/8 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
    <p>Dự án Ứng dụng phần mềm thông minh trong phát hiện và chăm sóc trẻ tự kỷ</p>
    </td>
    <td style="text-align:right;vertical-align:top">
    <p>&nbsp;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </center></td>
    </tr>
    </tbody>
    </table>

    ';//$fields['content'];
    $mail->CharSet="UTF-8";
    $mail->AddAddress($fields['email']);
    //$data = base64_decode($_POST['data']);
    $source = $_POST['source'];

    include("vendor/mpdf/mpdf/mpdf.php");
    $c = array(
        // mode: 'c' for core fonts only, 'utf8-s' for subset etc.
        'mode' => 'utf8',
        // page format: 'A0' - 'A10', if suffixed with '-L', force landscape
        'format' => 'A4',
         // default font size in points (pt)
        'font_size' => 1,
        // default font
        'font' => 'Arial',
        // page margins in mm
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0
    );
    $source = urldecode($source);
    $mpdf = new mPDF($c['mode'], $c['format'], $c['font_size'], $c['font']);
    $stylesheet = file_get_contents(get_template_directory_uri()."/css/style.css");
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($source, 2);
    $emailAttachment = $mpdf->Output('','S');
    //$emailAttachment = chunk_split(base64_encode($emailAttachment));
    //$mpdf->Output('/Users/duongquangvu/A365/a365_theme/filename.pdf','F');
    $filename = $_POST['testname'];
    $mail->AddStringAttachment($emailAttachment, $filename, 'base64', 'application/pdf');
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
};

if ($_POST['testname'] == 'asq')
    sendMailASQ();
if ($_POST['testname'] == 'mchatr')
    sendMailMchatR();
if ($_POST['testname'] == 'mchatrf')
    sendMailMchatRF();
if ($_POST['testname'] == 'qol')
    sendMailQOL();
if ($_POST['testname'] == 'atec')
    sendMailATEC();
if ($_POST['testname'] == 'theodoi')
    sendMailTheoDoi();
?>
