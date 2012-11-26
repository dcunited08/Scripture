<?php // licence: gpl-signature.txt
/*
    $username=stripslashes($_POST['regiuser']);
    $mail_body = "Your password is: $passwd\r\n"."May Gods peace be with you!\n"; //mail body
    $subject = "Welcome $username to $mailer_name. Here is your password"; //subject
    $header = "From: $mailer_name <$website_email>\r\n"; //optional headerfields
    $recipient =stripslashes($_POST['regiemail']); //recipient
*/
ini_set('sendmail_from', $website_email);
if(mail($recipient, $subject, $mail_body, $header)) {$mailok='1';}
elseif(!empty($smtp_host)){
    if((strpos($recipient,'hotmail')>=1)and!isset($allowhotmail)){die('hotmail not supported');}
    include('Mail.php');
    $recipients = array($recipient); # Can be one or more emails
    $headers = array ('From' => $website_email,'To' => join(', ', $recipients),'Subject' => $subject,);//
    $mail_object =& Mail::factory('smtp',array('host' => $smtp_host,'auth' => true,'username' => $smtp_username,'password' => $smtp_pass,#'debug' => true,
    ));
    $mail_object->send($recipients, $headers, $mail_body);
    $mailok='1';
}else{echo'<p>Message delivery failed...</p>';}
?>