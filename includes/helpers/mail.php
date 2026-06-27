<?php
    if(!function_exists("send_mail")){
        function send_mail(array $emails, string $subject, string $message){
            $headers  = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: " .config("mail.FROM_MAIL")."\r\n";
            return mail( $emails[0],  $subject,  $message, $headers);
        }
    }

//var_dump(send_mail(["yourgmail@test.com"], "hello", "welcom first mail"));