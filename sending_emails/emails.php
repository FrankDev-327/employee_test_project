<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class SendingEmails 
    {

        public function __construct($from, $to, $email, $subject, $text) 
        {
            $mail = new PHPMailer;
            $mail->isSMTP(); 
            $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = "smtp.gmail.com"; // use $Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is depracated
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->setFrom($from);
            $mail->addAddress($to,);
            $mail->Subject = $subject;
            $mail->AltBody = $text;
        }

        public function respondeEmailSent()
        {
            $response = false;
            if($this->mail->send()){
                $response = true;
                echo "Message sent!";
            } 
            return $response;
        }
    }
?>