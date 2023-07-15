<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '/sending_emails/emails.php';
    $data = json_decode(file_get_contents("php://input"));
    
    $emailSent = new SendingEmails(
        $data->from,
        $data->to,
        $data->email,
        $data->subject,
        $data->text
    );

    if($emailSent->respondeEmailSent()) {
        http_response_code(200);
        echo 'Email sent successfully.';
    } else {
        http_response_code(401);
        echo 'Email could not be sent.';
    }
  
?>