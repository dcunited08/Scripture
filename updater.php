<?php // licence: gpl-signature.txt
error_reporting(E_ERROR);
if (($uid == '1')or(!empty($firsttime))) {
    ini_set('max_execution_time', '0');
    if (!empty($_POST['install']) or !empty($_GET['updates']) or !empty($majorupdatelink)) {
      if(!file_exists('older_version')) {mkdir('older_version');}
      if (!empty($_POST['username'])) { $no_admin = '1'; }
      $new_shem = array('$username=\'databaseusername\';','$password=\'databasepassword\';','$database=\'database\';','$database_host=\'127.0.0.1\';',
			'$website_email="scripture@google.com";','$mailer_name = "Scripture Site";','$firsttime = \'1\';','require(\'starter.php\');',
			'&& empty($firsttime)','empty($firsttime) &&','$smtp_host=\'smtphost\';','$smtp_username=\'smtpuser\';','$smtp_pass=\'smtppass\';','or !empty($firsttime)');
      if (isset($_POST['install'])) { $username = $_POST['username'];$password = $_POST['password'];$database = $_POST['database'];$database_host = $_POST['database_host'];
				    $website_email = $_POST['website_email'];$mailer_name = $_POST['mailer_name']; $smtp_host=$_POST['smtphost'];$smtp_username=$_POST['smtpuser'];$smtp_pass=$_POST['smtppass'];}
      $old_shem = array('$username=\''.$username.'\';','$password=\''.$password.'\';','$database=\''.$database.'\';','$database_host=\''.$database_host.'\';',
			'$website_email="'.$website_email.'";','$mailer_name = "'.$mailer_name.'";','','','','','$smtp_host = "'.$smtp_host.'";','$smtp_username = "'.$smtp_username.'";','$smtp_pass = "'.$smtp_pass.'";','');
      $link=mysql_connect($database_host, $username, $password)  or die ('Error connecting to mysql');
      if (!empty($firsttime) && empty($majorupdatelink)) {
	  if (!empty($_POST['create'])) { $createdatabase = '1'; mysql_query("CREATE DATABASE IF NOT EXISTS `$database`;",$link) or die('unable to create database using host:'.$database_host.' u: '.$username.' p: '.$password); }
	  mysql_select_db($database, $link) or die('unable to select database'); mysql_set_charset('utf8');
	  $usernameadmin = $_POST['usernameadmin'];$passwordadmin = $_POST['passwordadmin'];$emailadmin = $_POST['emailadmin'];
      }
    }
    if (!empty($_GET['updates']) or !empty($majorupdatelink) or !empty($reconfiguredatabase) or !empty($firsttime)) {
	if (!empty($majorupdatelink)) { $toupdate = $majorupdatelink; } //used for major updates or download using index.php(not yet fully develop i think)
	elseif ((isset($_POST['install']) && !empty($reconfiguredatabase))or(!empty($firsttime))) { $toupdate = array('init.php'); }
	else { $toupdate = $_GET['updates']; }
	foreach($toupdate as $update) {
	    $update=urldecode($update);
	    if (isset($_POST['install']) or !empty($createdatabase)) { $update='init.php';$tmpfilename = 'init.php'; }
	    else { $tmpfilename = 'http://scripture.cvs.sourceforge.net/viewvc/scripture/scripture/'.$update.'?content-type=text%2Fplain&pathrev=HEAD'; }
	    require('inc/RemoteDownload.php');
	    if(file_exists($update)){
		$oldf='older_version/original_'.$update;
		if(file_exists($oldf)){unlink($oldf);}
		if(rename($update,$oldf)) {
		    echo'Original file saved as "'.$oldf.'"<br>';
		} else { echo('<p>There was an error moving '.$update.".</p>\r\n"); }
	    }
	    if ($update == 'init.php'){$file_contents = str_replace($new_shem,$old_shem,$file_contents);}
	    if(file_exists($update)){unlink($update);}
	    $updatetofile = fopen($update, 'a') or die('can\'t open file');		//file
	    fwrite($updatetofile,$file_contents);
	    fclose($updatetofile);
	}
	require('database.php');
	echo'<br><a href="index.php">Install/Update Complete. You may now use the site.</a>';
    }
}
else{ //sha key gen
    $ds = array('.','inc/','inc/Languages/');
    foreach($ds as $d){
      if($d!=='.'){$d2=$d;}else{unset($d2);}
      if ($handle = opendir($d)) {
	while (false !== ($file = readdir($handle))) {
	  if ($file!=='.' && $file!=='..') {
	    if (is_dir("$d/$file")) {}//dir
	    elseif(($file!=='init.php')and preg_match('/\.php$/',$file)) {echo $d2.$file.':'.sha1_file($d2.$file)."\n";}
	  }
	}
        closedir($handle);
      }
    }
}
// licence: gpl-signature.txt?>