<?php // licence: gpl-signature.txt
if(empty($u)){require('init.php');}
$passwd = substr(str_shuffle('qwertyuioasdfghjklzxcvbnm789456123'), mt_rand(0, 34), 7); // random password generator
echo'<a href="/index.php">Back</a>'.N;
if(($_POST['log']=='Recover')or(isset($_GET['r']))){
    $username=stripslashes($_POST['loguser']).$_GET['u'];$password = base64_encode(stripslashes($_POST['logpass']));
    if(!empty($_GET['p'])){$password=urldecode(stripslashes($_GET['p']));}
    $result_retrieve = mysql_query('SELECT * FROM users WHERE name=\''.$username.'\'',$link) or die();
    $userid=mysql_result($result_retrieve,0,'uid');
    $result_retrieve_t = mysql_query('SELECT * FROM bible_user_recovery WHERE auth=\''.$password.'\' and uid='.$userid,$link) or die();
    $num_bk_t=mysql_numrows($result_retrieve_t);
    if($num_bk_t<1){die('Access denied!.');}
    
    $username=mysql_result($result_retrieve,0,'name');
    $recipient=mysql_result($result_retrieve,0,'mail');
    $mail_body='Your password is: '.$passwd."\r\n".'May Gods peace be with you.'; //mail body
    $subject='New password for user '.$username.' at '.$mailer_name.'.'; //subject
    $header='From: '.$mailer_name.' <'.$website_email.">\r\n"; //optional headerfields
    require('inc/mail.php');
    if(!empty($mailok)){mysql_query('UPDATE users SET pass=\''.md5($passwd).'\' WHERE uid='.$userid);
    mysql_query('DELETE FROM bible_user_recovery WHERE uid='.$userid);
    echo'Authorization successful.<br>Check your email "'.$recipient.'" for a new password.'.N;}
    else{die('Error sending email; contact the web administrator if the trouble continues.');}
}
elseif (!empty($_POST['loguser'])) {
    $username=stripslashes($_POST['loguser']);$password = stripslashes($_POST['logpass']);
    $result_demo = mysql_query("SELECT uid,pass FROM users WHERE name='$username'") or die();
    $row_demo = mysql_fetch_object($result_demo);
    $uid = $row_demo->uid;
    $usercheckpass = $row_demo->pass;
    if ($usercheckpass===md5($password)) {
        $a = session_id();
        if(empty($a)) session_start();
        if(empty($extrasecf)){mysql_query("INSERT INTO sessions (uid, sid, hostname, timestamp, cache, session)
            VALUES ('$uid', '".session_id()."', '".$remoteaddr."', '".time()."','','')
            ON DUPLICATE KEY UPDATE hostname='".$remoteaddr."';");}
        mysql_query('UPDATE users set login=\''.time()."' where uid=".$uid);
        echo'<a href="index.php">Login Successful</a><meta HTTP-EQUIV="REFRESH" content="0; url="">';
    } else { echo'Access Denied!'; }
} // $_COOKIE["PHPSESSID"]
elseif(isset($_GET['logout'])){if($u != 'demo'){mysql_query('DELETE FROM sessions WHERE uid=\''.$uid.'\'');echo'<meta HTTP-EQUIV="REFRESH" content="3; url="">Logout Successful'.N;}}
elseif(isset($_GET['admin'])){
  if($uid!=='1'){die('Access Denied!.');}
    echo'<u>Administer Users</u>'.N;
    $s=mysql_query('select uid,name from users order by name ASC;');
    $n=mysql_numrows($s);
    $i=0;while($i<$n){
        $suid=mysql_result($s,$i,'uid');
        echo'<a href="users.php?admin&u='.$suid.'">'.mysql_result($s,$i,'name').' '.$suid.'</a>'.N;
        ++$i;
    }echo N;
  if(isset($_GET['u'])){
    echo'Function under construction(not prioritized.)'.$_GET['u'].NN;   
  }
}
elseif(isset($_GET['change'])){
    if(!empty($_POST['oldp'])and ($_POST['oldp']==stripslashes($_POST['oldpv']))){
        mysql_query('UPDATE users SET pass=\''.md5(stripslashes($_POST['newp'])).'\' where uid='.$uid.' and pass=\''.md5(stripslashes($_POST['oldp'])).'\'\';');
    }else{
    echo'<form action="?change" method="post" enctype="multipart/form-data">
        Old Password: <input type="password" name="oldp" value="">
        Verify Old Password: <input type="password" name="oldpv" value="">
        New Password: <input type="password" name="newp" value="">
        <input type="submit" value="Set"></form>';
        if(isset($_POST['oldp'])){echo N.'Password Mismatch'.N;}
    }
}
elseif (!empty($uid)) {
    if($l=='n'){require('inc/Languages/Menu_Norwegian.php');}
    else{require('inc/Languages/Menu_English.php');}
    echo'<b>'.$l_m8.'</b><a href="/?mypage=1'.$bl.$bookli.'">'.$l_m9.'</a>'.NN;
    echo'Logged in as: '.$u.' Your uid: '.$uid.' <a href="users.php?logout">Logout</a>'.NN;
    if($uid!=='0'){echo'<a href="users.php?change">Change Password</a>'.N;}
    if($uid==='1'){echo'<a href="users.php/?admin">Administer Users</a>'.N;}
}
elseif (!empty($_POST['regipass'])) { // registration
    if(empty($_POST['regiuser']) or empty($_POST['regiemail'])){die('All fields needs to be filled');}
    $username=stripslashes($_POST['regiuser']);
    $mail_body = "Your password is: $passwd\r\n"."May Gods peace be with you!\n"; //mail body
    $subject = "Welcome $username to $mailer_name. Here is your password"; //subject
    $header = "From: $mailer_name <$website_email>\r\n"; //optional headerfields
    $recipient = stripslashes($_POST['regiemail']); //recipient
    require('inc/mail.php');
    if(!empty($mailok)){
        mysql_query("INSERT INTO users (uid, name, pass, mail, mode, sort, threshold, theme, signature, signature_format, created, access, login, status, timezone, language, picture, init, data, timezone_name)
               VALUES (NULL, '$username', '".md5($passwd)."', '$recipient', '0', '0', '0', '', '', '0', '".time()."', '0', '0', '1', NULL, '', '', '$recipient', NULL, '');");
        echo'<p>Email sent with your password.</p>';
        $a = session_id();
        if(empty($a)) session_start();
        $username = stripslashes($_POST['regiuser']);
        $result_demo = mysql_query('SELECT uid FROM users WHERE name='."'$username'",$link) or die();
        $row_demo = mysql_fetch_object($result_demo);
        $uid = $row_demo->uid;
        mysql_query('INSERT INTO '.".sessions (sid, uid, cache, hostname, session, timestamp)
                    VALUES ('".session_id()."', '$uid', NULL, '$remoteaddr',NULL, '".time()."')");
        mysql_query("INSERT INTO bible_user_settings (`$uid`, fontcolor, fontbackground, fontsize,versehighlightcolor, font, lasturl, lastip, settings)
                    VALUES ('$uid', '', '', '3', 'blue', '', NULL, '$remoteaddr', '');");

       //echo "SID: ".SID."<br>session_id(): ".session_id()."<br>COOKIE: ".$_COOKIE["PHPSESSID"];
       echo '<meta HTTP-EQUIV="REFRESH" content="3; url="">';
    }
} elseif (!empty($_POST['forgot'])){
    $username=stripslashes($_POST['regiuser']);$email=stripslashes($_POST['regiemail']);
    if (!empty($email)) {$regiget=stripslashes($_POST['regiemail']);$regiget2='mail=';} elseif(!empty($username)){$regiget=stripslashes($_POST['regiuser']);$regiget2='name=';}
    $result_retrieve = mysql_query("SELECT * FROM users WHERE $regiget2'$regiget'",$link) or die();
    $num_bk=mysql_numrows($result_retrieve);
    if($num_bk>0) {
        $userid=mysql_result($result_retrieve,0,'uid');
        $result_retrieve_t = mysql_query('SELECT * FROM bible_user_recovery WHERE uid='.$userid,$link) or die();
        $num_bk_t=mysql_numrows($result_retrieve_t);
        if($num_bk_t>10){die('Too many tries; contact the web administrator for further assistance.');}
        $username=mysql_result($result_retrieve,0,'name');
        $recipient=mysql_result($result_retrieve,0,'mail');
        $ps=base64_encode($passwd);
        $mail_body='Your recover password is: '.$passwd."\r\n".stripslashes($_SERVER['SCRIPT_URI']).'/?u='.$username.'&r&p='.urlencode($ps)."\r\n".'May Gods peace be with you.'; //mail body
        $subject='Recovery for user '.$username.' at '.$mailer_name.'. Here is your recovery password'; //subject
        $header='From: '.$mailer_name.' <'.$website_email.">\r\n"; //optional headerfields
        require('inc/mail.php');
        if(!empty($mailok)){mysql_query('INSERT INTO bible_user_recovery (rid,uid,mail,date,auth)
                            VALUES (NULL,'.$userid.',\''.$recipient.'\',\''.time().'\',\''.$ps.'\');');
        echo'Check your email.'.N;
        } //u p r
    } else {die('No user found by that email or username.');}
}
elseif(empty($u)or($u=='demo')) {
    // login,registration,recovery form
    require('inc/user_forms.php');
}

if (!empty($_POST['extrapuser'])) { //extra security
    $extrap = stripslashes($_POST['extrapass']);
    $extrapuser = stripslashes($_POST['extrapuser']);
    //echo$extratologin;
    echo'Password checked; Navigate back to frontpage.'.N;
    if (!empty($extrap)) {
        echo$extrap;
        if($extrap !== $user_extra_sec){die("Access denied!");}
        $extraseid = md5($extrap.session_id());
        $setesec='1';
    }
    mysql_query('DELETE FROM sessions WHERE uid='.$uid);
    if(!empty($setesec)){mysql_query('INSERT INTO sessions (uid,sid,hostname,timestamp,cache,session)
        VALUES ('.$uid.',\''.$extraseid.'\',\''.$remoteaddr.'\',\''.time().'\',NULL,NULL);');}
}
elseif (!empty($u) and ($u !== 'demo')) { //extra security form
    echo '<form action="" method="post" enctype="multipart/form-data">
        Mini password(Session security): <input type="password" name="extrapass" value="">
        <input type="hidden" name="extrapuser" value="'.$uid.'">
        <input type="submit" value="Set"><input type="submit" value="Remove"></form>';
}
elseif(!empty($extrasecf)){
    mysql_close();
    unset($username,$password,$database,$database_host);
    echo'<form action="users.php" method="post" enctype="multipart/form-data">
    Session security.
    Password: <input type="password" name="extrapass" value="">
    <input type="hidden" name="extrapuser" value="'.$u.'">
    <input type="submit" value="Login"></form>';
}
if(!empty($referer)and!isset($fp)and!isset($didback)){$didback=1;echo'<p><a href="'.$referer.'">Back</a></p>';}
// licence: gpl-signature.txt?>