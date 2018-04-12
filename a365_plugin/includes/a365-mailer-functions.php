<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Mailer functions
 **/

function a365_contact() {
    // parse serialized string

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
    $mail->Subject = "=?UTF-8?B?".base64_encode($_POST['title'])."?=";
    $mail->IsHTML(true);
    $mail->CharSet="UTF-8";
    $mail->AddAddress("support.a365@ccihp.org");
    $mail->msgHTML('
        <b>Tên người gửi: </b>'.$_POST['fullname'].'<br>
        <b>Email liên hệ: </b>'.$_POST['email'].'<br>
        <b>Nội dung: </b>'.$_POST['content'].'<br>
    ');
    //$data = base64_decode($_POST['data']);
    if(!$mail->Send()) {
        $response = array('status' => 'fail');
        echo json_encode($response);
        wp_die();
    } else {
        $response = array('status' => 'success');
        echo json_encode($response);
        wp_die();
    }
}

add_action( 'wp_ajax_contact', 'a365_contact' );
add_action( 'wp_ajax_nopriv_contact', 'a365_contact' );