<?php # licence: gpl-signature.txt
if(!empty($_SERVER['HTTP_X_REMOTE_ADDR'])){$remoteaddr=$_SERVER['HTTP_X_REMOTE_ADDR'];}
else{$remoteaddr=$_SERVER['REMOTE_ADDR'];}
if((substr($remoteaddr,0,9)=="91.201.64")or(strstr($_SERVER['QUERY_STRING'],'php://'))){die('access denied');}
$time=explode(' ',microtime());$start=$time[1] + $time[0];error_reporting(E_ERROR);
$username='databaseusername'; $password='databasepassword'; $database='database'; $database_host='127.0.0.1'; $website_email="scripture@google.com"; $mailer_name = "Scripture Site"; $firsttime = '1'; $smtp_host='smtphost';$smtp_username='smtpuser';$smtp_pass='smtppass';
ini_set('memory_limit', '32M');
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){ob_start('ob_gzhandler');$gzip='1';}else{ob_start();}
if(empty($no_sqlconnect) && empty($firsttime)){$link=mysql_connect($database_host,$username,$password);
  mysql_select_db($database,$link);mysql_set_charset('utf8');
  /*$mysqli=new mysqli($database_host,$username,$password,$database); #disabled as it's slower than mysql_
  if ($mysqli->connect_errno) {echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;}*/
  $password='Yeah123';$username='kdfk';
}
define('N','<br>'."\n"); define('NN','<p></p>'."\n");
$mobl=strtolower($_SERVER['HTTP_USER_AGENT']);
if((strpos($mobl,'ipad')>0)or(strpos($mobl,'windows')>0)or(strpos($mobl,'linux')>0)){$no_mobile='1';}

/*
function mysql_query_s2($ssql){
  $ssql=preg_replace('/(\\?\')/',"\\test'",$ssql); $ssql=preg_replace('/(\\?\")/','\\test"',$ssql);
  return$ssql;
}
*/
if(isset($_GET['nm'])or(strpos($mobl,'android')>0)){unset($no_mobile);}//or(strpos($mobl,'iPhone')>0)
if(isset($_GET['fp'])){$fp='1';}
elseif(isset($_GET['forum'])){$forum=$_GET['forum'];}
elseif(isset($_GET['groups'])){$groups=$_GET['groups'];}
if(!empty($_GET['b'])){$b=$_GET['b'];}
 elseif(!empty($_POST['b'])){$b=$_POST['b'];}
 else{
  if(empty($_SERVER['QUERY_STRING'])){$fp='1';}
  elseif(isset($_GET['br'])){
    #$doexpro=$_SERVER['HTTP_REFERER'];
    parse_str($_SERVER['HTTP_REFERER'],$doexprop);
    $b=$doexprop['b'];
  }
 }
if(empty($_POST['loguser'])&&empty($firsttime)){// user check
  $uid=mysql_result(mysql_query('SELECT uid FROM '.$database.'.sessions WHERE hostname=\''.stripslashes($remoteaddr).'\''),'0','uid');
  if(!empty($uid)){
    $uid=stripslashes($uid);
    $r=mysql_query('SELECT name,extra_sec FROM '.$database.'.users WHERE uid='.$uid);
    $u=stripslashes(mysql_result($r,'0','name'));$user_extra_sec=mysql_result($r,'0','extra_sec');
    $r=mysql_query('SELECT * FROM '.$database.'.bible_user_settings WHERE user_id='.$uid); //user settings
    $mysettings=explode('_',mysql_result($r,'0','settings'));$thid=mysql_result($r,'0','theme');
   if(!empty($_GET['s'])and(strstr($_GET['s'],'(')==FALSE)){
    $r=mysql_query('SELECT nid,line FROM '.$database.'.bible_userlisthist WHERE uid='.$uid.' and line=\''.stripslashes($_GET['s']).'\';');//history logging
    $resultuchecknid=mysql_result($r,'0','nid');$resultucheck=mysql_result($r,'0','line');
    if(empty($resultucheck)){mysql_query('INSERT INTO '.$database.'.bible_userlisthist (nid, uid, status, created, updated, line) VALUES (NULL,'.$uid.',1,  UNIX_TIMESTAMP(), UNIX_TIMESTAMP() ,\''.stripslashes($_GET['s']).'\')');}
    else{mysql_query('UPDATE '.$database.'.bible_userlisthist set updated=UNIX_TIMESTAMP() where nid='.$resultuchecknid);}
  }
 }else{$u='demo';$uid='0';
 if(isset($no_mobile)){
/*$gad='<script type="text/javascript"><!--
google_ad_client = "ca-pub-1016728984988174";
// ScriptureBanner 
google_ad_slot = "4740941103";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>';
if(!empty($fp)){$gad.='<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=198732743489367";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';}
*/
  }
}
#$ssql=preg_replace("/([\\]?\')/","\'",$ssql);
#$ssql=preg_replace('/([\\]?\")/','\"',$ssql);
}
function mysql_query_s($ssql){
  if($GLOBALS['uid']!=1){if(strstr($ssql,'<?')or strstr($ssql,'?>') or stristr($ssql,'$database')or
   stristr($ssql,'$username')or stristr($ssql,'drop table')or stristr($ssql,'drop database')){die('Access denied!');}}
  return mysql_query($ssql);
}
/*function mysqlis($ssql){ #disabled as it's slower than mysql_
  if($GLOBALS['uid']!=1){if(strstr($ssql,'<?')or strstr($ssql,'?>') or strstr($ssql,'$database')){die('Access denied!');}}
  return $GLOBALS['mysqli']->query($ssql);
}*/
if(empty($_POST['loguser'])&&empty($firsttime)){// user check
if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2)=='no'){$l='n';}
else{$l=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);}
$thelanguage=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
if(!isset($nocount)and($uid!=='1')and!preg_match('/(facebookexternalhit|bingbot|linkfinder|spider|Google|msnbot|Rambler|Yahoo|Yammybot|openbot|AbachoBOT|accoona|AcioRobot|ASPSeek|Dumbot|Crawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby|DoCoMo|Teoma|Slurp|archiver)/i',$mobl)){
 if($uid!=='0'){$u2=$u;}
 $split_ip=explode('.',$remoteaddr);
 $geodata=$split_ip[0]*16777216+$split_ip[1]*65536+$split_ip[2]*256+$split_ip[3];
 $return=mysql_result(mysql_query_s('Select visitors_id from '.$database.'.bible_visitors where visitors_ip=\''.$remoteaddr.'\''),'0','visitors_id');
 if(empty($return)){$new='1';$sthelanguage=stripslashes($thelanguage);$newagent=stripslashes($_SERVER['HTTP_USER_AGENT']);}
 mysql_query_s('INSERT INTO '.$database.'.bible_visitors (visitors_id,visitors_uid,visitors_ip,visitors_date_time,visitors_url,visitors_referer,visitors_path,visitors_title,visitors_user_agent,geodata,new,lang) VALUES '."
  ('',$uid,'$remoteaddr',unix_timestamp(),'".stripslashes($_SERVER['QUERY_STRING'])."','".stripslashes($_SERVER['HTTP_REFERER'])."','".stripslashes($_SERVER['SCRIPT_NAME'])."','$u2','".$newagent."','$geodata','$new','$sthelanguage')");
}elseif($uid!=='1'){$dopic=1;}
if(strstr($mobl,'opera')or strstr($mobl,'msie')){$badbrowse=1;}//if($uid==1){echo$mobl;}
/*
 //$result_demo=mysql_query_s("SELECT uid FROM users WHERE name='$u'") or die();$row_demo=mysql_result($result_demo,'0','uid');
 1979717123   - banner
 google_ad_slot = "4740941103";
google_ad_width = 728;
google_ad_height = 90;

google_ad_width = 468;
google_ad_height = 60;
*/
  if(!empty($user_extra_sec)&&empty($_POST['extrapass'])){require('inc/user_extrasecurity.php');} //extra security
  $r=mysql_query_s('SELECT * FROM '.$database.'.bible_settings'); //Global settings
  $gstrong=mysql_result($r,'0','strong');$gbible=mysql_result($r,'0','bible');$gsuper=mysql_result($r,'0','defaultsuper');
  if(!empty($mysettings[6])){$gstrong=$mysettings[6];}
  if(!empty($mysettings[12])){$gsuper=$mysettings[12];}
  if(!empty($mysettings[13])){$gbible=$mysettings[13];}
  if(empty($thid)){$thid=mysql_result($r,'0','theme');if(empty($thid)){$thid='20';}}
}
if(empty($b)){if($l=='n'){$b='6';}
elseif($l=='ru'){$b='52';}
elseif($l=='de'){$b='7';}
elseif($l=='es'){$b='38';}
elseif($l=='fr'){$b='43';}
elseif($l=='ar'){$b='19';}
else{$b=$gbible;}}
//unset($gzip);
if((isset($_GET['forum'])and(isset($_GET['edit'])||isset($_GET['createcontent']))||isset($_GET['mypage']))and($mysettings[10]>='2')){
  require('inc/editors.php');
  $em=$jedit2;
}
if(isset($fp)and(!isset($notitle))){$mname='<title>BibleWay</title>';
if(isset($no_mobile)){$docss=1;}} //<meta NAME=”Description” CONTENT=”Scripture is a fully-featured (PHP) online and Mobile study application. It allows users to read, interact and study the Bible using many unique features and tools. Scripture.sf.net - Crossplatform Biblestudy ∫∞≡Ε The Scriptures Matters" >
if(!isset($notype)){echo'<!doctype html><html><head>'.$mname.$em;
if(isset($_GET['scroll'])){require('inc/ajax/scroll/index.php');}
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 30));
echo'<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="width">
<meta name="viewport" content="width=device-width" user-scalable="yes">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
if(!isset($_GET['uf'])){$hitstyle=1;echo $headex;}
require('inc/theme_loader.php');
if(isset($_GET['alv'])or isset($jsdo)){echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>';if(!isset($jsdo)){require('inc/ajax/admin_lastvisitor_js.php');}}
if(isset($_GET['tea'])){if(isset($no_mobile)){echo'<script type="text/javascript" src="inc/jscolor/jscolor.js"></script>';}}
if(isset($doscript)){echo$doscript;}
if(isset($_GET['edf'])){echo'<script src="/inc/codepress/codepress.js" type="text/javascript"></script>';}
echo$editor.$gad.'</head><body'.$scrollbload.'>';}
//if(isset($dopic)){echo N.'<img src="img/FB_Scripture.png">'.N.'<table><tr><td>Opensource Biblestudy.<br>Study the bible for free using all your connectable devices.</td></tr></table>'.NN.NN.NN;}
$footer='</body></html>';
if(isset($_GET['gs'])){$getstrong=$_GET['gs'];}elseif(isset($_GET['getstrong'])){$getstrong=$_GET['getstrong'];}else{$getstrong="";}
if(isset($_GET['bk'])){$book=$_GET['bk'];}else{$book='MAT';}
if(isset($_GET['xref'])){$xref=$_GET['xref'];}
if(isset($_GET['ch'])){$chbf=$_GET['ch'];}
if(isset($_GET['setbookmark'])){$setbookmark=$_GET['setbookmark'];}
elseif(isset($_GET['bookmark'])){$bookmark=urldecode($_GET['bookmark']);}
if(isset($_GET['uf'])){$userfeatures=urldecode($_GET['uf']);}elseif(isset($_GET['userfeatures'])){$userfeatures=urldecode($_GET['userfeatures']);}
if(isset($_GET['setnote'])){$setnote=$_GET['setnote'];}
if(isset($_GET['setnote2'])){$setnote2=$_GET['setnote2'];}
if(isset($_GET['setxref'])){$setxref=$_GET['setxref'];}
elseif(isset($_GET['setfavorite'])){$setfavorite=$_GET['setfavorite'];}
if(isset($_GET['note'])){$note=$_GET['note'];}
if(isset($_GET['favorite'])){$favorite=$_GET['favorite'];}
if(isset($_GET['cross'])){$cross=$_GET['cross'];}
if(isset($_GET['reref'])){$reref=urldecode($_GET['reref']);}
if(isset($_GET['mydata'])){$mydata=urldecode($_GET['mydata']);}
  elseif(isset($_POST['mydata'])){$mydata=urldecode($_POST['mydata']);}
if(isset($_GET['mode_tt'])){$mode_tt=urldecode($_GET['mode_tt']);}
  elseif(isset($_POST['mode_tt'])){$mode_tt=urldecode($_POST['mode_tt']);}
if(empty($mysettings[11])){$mysettings[11]='3';}//default frontpage

if(is_array($b)){
  if(empty($b[1])){$b=$b[0];if(strstr($b,',')){$ismultib=explode(',',$b);}}
  elseif(strstr($b,',')){$ismultib=explode(',',$b);}
  else{$ismultib=$b;$b=implode(',',$b);}
}
elseif(!empty($b)){
  if(strstr($b,',')){$ismultib=explode(',',$b);}
} //$ismultib=array();$ismultib=$b;
$bl='&b='.$b;
if(!empty($ismultib)){foreach($ismultib as $multi_b_t){$bdir.='_'.trim($multi_b_t);}}
if(!empty($mysettings[16])){
  if($mysettings[16]!=='n'){$doeditb=$mysettings[16];}
  if(!empty($ismultib)){foreach($ismultib as $multi_b_t){if($doeditb==$multi_b_t){$founded=1;}}}
  elseif($b==$doeditb){$founded=1;}
  if(!isset($founded)){unset($doeditb);}
}
if(isset($_GET['cs'])){$chap=$_GET['cs'];}
elseif(isset($_GET['c'])){$chap=$_GET['c'];}elseif(empty($chap)){$chap='5';}
if(isset($_GET['tools'])){$tools=$_GET['tools'];}elseif(isset($_POST['tools'])){$tools=urldecode($_POST['tools']);}
if(!empty($chap)){$prechap=$chap - 1;$postchap=$chap + 1;}
if($chbf == '<<'){$chap=$prechap;}elseif($chbf == '>>'){$chap=$postchap;}
$subd=$_SERVER['SCRIPT_NAME'];$subd=explode('/',$subd);
if(stripos($subd[2],'.php')>'1'){$subd='/'.$subd[1];}else{$subd="";}
if($uid==='1'){$time=explode(' ',microtime());$time=$time[1] + $time[0];$time_init=$time;}
if(!$link){echo'<h1>MySQL Database down for maintenance.<br>(back in a short while)</h1><br>';}
# licence: gpl-signature.txt?>