<?php
require('../init.php');
if($uid==1){
    echo '<form action="" method="post" enctype="multipart/form-data">
        Subject<br><input type="text" name="subject" size="24" value="'. $_POST['subject'].'"><br>
        Body<br><textarea rows="14" id="body" name="body"></textarea><br>
        <input type="submit" value="mail"></form>';
    $mail_body =$_POST['subject']; //mail body
    $subject =$_POST['subject']; //subject
    $header = "From: $mailer_name <$website_email>\r\n"; //optional headerfields
     //recipient
if(!empty($mail_body)){
$s=mysql_query('SELECT mail FROM users where 1;');
 $n=mysql_numrows($s);
 $recipient="";$allowhotmail=1;
 $i=0;while($i<=$n){
    //if(isset($recipient)){$recipient.=', '.mysql_result($s,$i,'mail');}
    //else{$recipient.=mysql_result($s,$i,'mail');}
    $recipient=mysql_result($s,$i,'mail');
    //sleep(10);
    //require('mail.php');
    echo$recipient.'<br>';
    ++$i;
 }
 //require('mail.php');
 echo $n.'<br>Sent to'.$recipient;
}
}
?>