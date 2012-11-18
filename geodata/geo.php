<?php // licence: gpl-signature.txt
$nodiv='1';
if(!isset($password)){require('../init.php');}
$time=explode(' ',microtime());$time1_res=(float)$time[1] + (float)$time[0];
$now=time();
if(isset($_GET['fday'])){
    $fmonth=$_GET['fmonth'];
    $fday=$_GET['fday'];
    $fyear=$_GET['fyear'];
    
    $tmonth=$_GET['tmonth'];
    $tday=$_GET['tday'];
    $tyear=$_GET['tyear'];
    $prevmonth=mktime(0,0,0,$fmonth,$fday,$fyear);
    $thismnt=mktime(0,0,0,$tmonth,$tday,$tyear);
    $not_now='1';
}else{
    $fmonth=date("n");$fday=date("j");$fyear=date("Y");
    $tmonth=date("n")+1;$tday=date("j");$tyear=date("Y");
}
if(!empty($_GET['qc'])){
    $qc=$_GET['qc'];
    $not_now='1';
    if($qc=='lm'){
        $fhour=0;$fmonth=date("n")-1;$fday=0;$fyear=date("Y");
        $thour=0;$tmonth=date("n");$tday=0;$tyear=date("Y");
    }elseif($qc=='tm'){
        $fhour=0;$fmonth=date("n");$fday=1;$fyear=date("Y");
        $thour=23;$tmonth=date("n");$tday=date("j");$tyear=date("Y");
    }elseif($qc=='td'){
        $fhour=0;$fmonth=date("n");$fday=date("j");$fyear=date("Y");
        $thour=0;$tmonth=date("n");$tday=date("j")+1;$tyear=date("Y");
    }elseif($qc=='th'){
        $fhour=date("H");$fmonth=date("n");$fday=date("j");$fyear=date("Y");
        $thour=date("H")+1;$tmonth=date("n");$tday=date("j");$tyear=date("Y");
    }elseif($qc=='ly'){
        $fhour=0;$fmonth=0;$fday=0;$fyear=date("Y")-1;
        $thour=0;$tmonth=0;$tday=0;$tyear=date("Y");
    }elseif($qc=='ty'){
        $fhour=0;$fmonth=0;$fday=0;$fyear=date("Y");
        $thour=date("H");$tmonth=date("n");$tday=date("j");$tyear=date("Y");
    }elseif($qc=='lw'){
        $fhour=date("H");$fmonth=date("n");$fday=date("j")-7;$fyear=date("Y");
        $thour=date("H");$tmonth=date("n");$tday=date("j");$tyear=date("Y");
    }
    $prevmonth=mktime($fhour,0,0,$fmonth,$fday,$fyear);
    $thismnt=mktime($thour,0,0,$tmonth,$tday,$tyear);
}
//echo'month: '.$_GET['tmonth'].' year: '.$_GET['tyear'].' day: '.$_GET['tday'];
//demographics:
if(!isset($not_now)){
$cday=date("j");$cMonth=date("n");$cYear=date("Y");
$thisday=mktime(0,0,0,$cMonth,$cday,$cYear);
$yesterday=mktime(0,0,0,$cMonth,$cday-1,$cYear);
$last_month=mktime(0,0,0,$cMonth-1,0,$cYear);
$last_month_end=mktime(0,0,0,$cMonth,1,$cYear)-1;
$this_month=mktime(0,0,0,$cMonth,1,$cYear);
/*
year 31622400
month 2592000
week 604800
day 86400
hour 3600
*/
$s=mysql_query("SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=$thisday");
$sv_today=mysql_result($s,0,'C');
$s=mysql_query("SELECT count(new) AS C from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=$thisday and new=1");
$snew_today=mysql_result($s,0,'C');
$s=mysql_query("SELECT visitors_uid from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=$thisday");
$svhits_today=mysql_numrows($s);
$s=mysql_query("SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<".$thisday." AND visitors_date_time >=$yesterday");
$sv_yesterday=mysql_result($s,0,'C');
$s=mysql_query("SELECT count(new) AS C from bible_visitors WHERE visitors_date_time<".$thisday." AND visitors_date_time >=$yesterday and new=1");
$snew_yesterday=mysql_result($s,0,'C');
$s=mysql_query("SELECT visitors_uid from bible_visitors WHERE visitors_date_time<".$thisday." AND visitors_date_time >=$yesterday");
$svhits_yesterday=mysql_numrows($s);
$s=mysql_query("SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=".($now -604799));
$sv_week=mysql_result($s,0,'C');
$s=mysql_query("SELECT count(new) AS C from bible_visitors WHERE new=1 and visitors_date_time<=$now AND visitors_date_time >=".($now -604799));
$snew_week=mysql_result($s,0,'C');
$s=mysql_query("SELECT visitors_uid from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=".($now -604799));
$svhits_week=mysql_numrows($s);
$s=mysql_query("SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=$this_month");
$sv_lastmonth=mysql_result($s,0,'C');
$s=mysql_query("SELECT visitors_uid from bible_visitors WHERE visitors_date_time<=$now AND visitors_date_time >=$this_month");
$svhits_lastmonth=mysql_numrows($s);

$s=mysql_query("SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<=$last_month_end AND visitors_date_time >=$last_month");
$sv_pastmonth=mysql_result($s,0,'C');
$s=mysql_query("SELECT visitors_uid from bible_visitors WHERE visitors_date_time<=$last_month_end AND visitors_date_time >=$last_month");
$svhits_pastmonth=mysql_numrows($s);

$d=array();$d2=array();$uwk=86400;
$d[1]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<='.$now.' AND visitors_date_time >='.($now -$uwk)),0,'C');
$d[2]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -$uwk).' AND visitors_date_time >='.($now -($uwk*2))),0,'C');
$d[3]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*2)).' AND visitors_date_time >='.($now -($uwk*3))),0,'C');
$d[4]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*3)).' AND visitors_date_time >='.($now -($uwk*4))),0,'C');
$d[5]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*4)).' AND visitors_date_time >='.($now -($uwk*5))),0,'C');
$d[6]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*5)).' AND visitors_date_time >='.($now -($uwk*6))),0,'C');
$d[7]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*6)).' AND visitors_date_time >='.($now -($uwk*7))),0,'C');

$d2[8]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*7)).' AND visitors_date_time >='.($now -($uwk*8))),0,'C');
$d2[9]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*8)).' AND visitors_date_time >='.($now -($uwk*9))),0,'C');
$d2[10]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*9)).' AND visitors_date_time >='.($now -($uwk*10))),0,'C');
$d2[11]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*10)).' AND visitors_date_time >='.($now -($uwk*11))),0,'C');
$d2[12]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*11)).' AND visitors_date_time >='.($now -($uwk*12))),0,'C');
$d2[13]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*12)).' AND visitors_date_time >='.($now -($uwk*13))),0,'C');
$d2[14]=mysql_result(mysql_query('SELECT count(distinct visitors_ip) AS C from bible_visitors WHERE visitors_date_time<'.($now -($uwk*13)).' AND visitors_date_time >='.($now -($uwk*14))),0,'C');

echo'<center><u>Visitors Last 2 times 7 24-hour periods(days ago)</u>'.N;
require($dirextra.'../inc/graph.php');

echo N.'<u>Demographics</u><br>Visits today: '.$sv_today.' With '.$svhits_today.' Pageviews. New:'.$snew_today.N.
    'Yesterday: '.$sv_yesterday.' With '.$svhits_yesterday.' Pageviews. New:'.$snew_yesterday.N.
    'Last 7days: '.$sv_week.' With '.$svhits_week.' Pageviews. New:'.$snew_week.N.
    'This month: '.$sv_lastmonth.' With '.$svhits_lastmonth.' Pageviews.'.N.
    'Last month: '.$sv_pastmonth.' With '.$svhits_pastmonth.' Pageviews.</center>'.NN;

//$monthNames = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
if (!isset($_REQUEST["month"])){$cMonth=date("n");}else{$cMonth=$_REQUEST["month"];$notime=1;}
if (!isset($_REQUEST["year"])){$cYear=date("Y");}else{$cYear=$_REQUEST["year"];}
$cday=date("j");
$prev_year = $cYear; $next_year = $cYear;
$prev_month = $cMonth-1; $next_month = $cMonth+1;
if ($prev_month == 0 ) {
 $prev_month = 12;
 $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
 $next_month = 1;
 $next_year = $cYear + 1;
}
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday= date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday  = $thismonth['wday'];
$prevmonth=mktime(0,0,0,$cMonth,-30,$cYear);
$thismnt=mktime(0,0,0,$cMonth,$cday+1,$cYear);
if(isset($notime)){$thismnt=$now;}
}
//print_r($thismonth);
//echo$thismnt.'nextm: '.$prevmonth.NN;
$sgeos=mysql_query("SELECT visitors_ip,geodata from bible_visitors WHERE visitors_date_time<=$thismnt AND visitors_date_time >=$prevmonth  group by visitors_ip");
$sgeos_num=mysql_numrows($sgeos);
//echo "SELECT geodata from bible_visitors WHERE visitors_date_time<=$thismnt AND visitors_date_time >=$prevmonth group by visitors_ip".N;
$ir=0;$sgeo_a=array();$sgeo_count=array();
$time=explode(' ',microtime());$time1_res=(float)$time[1] + (float)$time[0];
$itmp=0;
$i=0;while($i<=$sgeos_num){
    $sgtmp=mysql_result($sgeos,$i,'geodata');
  if(!empty($sgtmp)){
    $sres=mysql_result(mysql_query('SELECT locId from bible_geoip WHERE IpNum='.$sgtmp),0,'locId');
    if(($sgtmp!==$sgtmp2)&&empty($sres)){
        $sgtmp2=$sgtmp;
        $sres=mysql_result(mysql_query('SELECT locId from geoblocks WHERE startIpNum<='."$sgtmp AND endIpNum>=$sgtmp;"),0,'locId');
        if(!empty($sres)){mysql_query('INSERT INTO bible_geoip (locId,IpNum) VALUES('."$sres,$sgtmp);");}
        else{mysql_query('INSERT INTO bible_geoip (locId,IpNum) VALUES(1,'."$sgtmp);");}
    }
    if(!empty($sres)){
        if(!isset($sgeo_count[$sres])){$sgeo_a[$ir]=$sres;++$ir;}
        $dosc=1;++$sgeo_count[$sres];
    }
  }
++$i;
++$itmp;
}
//print_r($sgeo_count);
//echo'<br>';
$thefile='Scripture_Monthly_'.$now.'.kml';
$subdirt=preg_match('/(^http\:\/)(\/[^\.]*)[\/]/i',$_SERVER['PHP_SELF'],$subdir);
if(!file_exists($dirextra.'kml')) {mkdir($dirextra.'kml') or die('unable to create directory');chmod($dirextra.'kml',0755);echo'directory kmp/ created'.N;}
if (file_exists($dirextra.'kml/'.$thefile)) { unlink($dirextra.'kml/'.$thefile); }
if(count(glob($deldir. "*"))>30){
    $deldir=$dirextra.'kml/';
    foreach(glob($deldir.'*.*') as $v){unlink($v);}
}

$fh = fopen($dirextra.'kml/'.$thefile, 'a+') or die('Unable to open target location: kml/'.$thefile);
if(isset($dirextra)){$dirextra3='../';}
echo'<center><u>Geographics - Unique Visitors This Month</u>'.
'<form action="'.$dirextra3.'index.php" method="get"><input type="hidden" name="geo">From: Day<select style="width:105" name="fday">';
$i=1;while($i<=31){if($i==$fday){$sel=' selected';}elseif(isset($sel)){unset($sel);}echo"<option value=\"$i\"$sel>$i</option>";++$i;}
echo'</select>Month<select style="width:105" name="fmonth">';
$i=1;while($i<=12){if($i==$fmonth){$sel=' selected';}elseif(isset($sel)){unset($sel);}echo'<option value="'.$i.'"'.$sel.'>'.$i.'</option>';++$i;}
$toyear=date("Y");$numyears=$toyear -2010;
echo'</select>Year<select style="width:105" name="fyear">';
$i=0;while($i<=$numyears){if(($toyear-$i)==$fyear){$sel=' selected';}elseif(isset($sel)){unset($sel);}echo'<option value="'.($toyear-$i).'"'.$sel.'>'.($toyear-$i).'</option>';++$i;}
echo'</select><br>To: Day<select style="width:105" name="tday">';
$i=1;while($i<=31){if($i==$tday){$sel=' selected';}elseif(isset($sel)){unset($sel);}echo'<option value="'.$i.'"'.$sel.'>'.$i.'</option>';++$i;}
echo'</select>Month<select style="width:105" name="tmonth">';
$i=1;while($i<=12){if($i==$tmonth){$sel=' selected';}elseif(isset($sel)){unset($sel);}echo'<option value="'.$i.'"'.$sel.'>'.$i.'</option>';++$i;}
echo'</select>Year<select style="width:105" name="tyear">';
$i=0;while($i<=$numyears){if(($toyear-$i)==$tyear){$sel=' selected';}elseif(isset($sel)){unset($sel);}echo'<option value="'.($toyear-$i).'"'.$sel.'>'.($toyear-$i).'</option>';++$i;}
echo'</select><br><select style="width:105" name="qc"><option value="" selected>Quick Choices</option>
<option value="tm">This Month</option>
<option value="lm">Last Month</option>
<option value="lw">Last 7days</option>
<option value="td">This Day</option>
<option value="th">This Hour</option>
<option value="ty">This Year</option>
<option value="ly">Last Year</option></select>'.
'<input type="submit" value="Go"></form></center>';
fwrite($fh,'<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2">
<Document><name>Scripture</name>
<description>Visitors Last Month</description>');
//worldmap image
$image_worldmap=$dirextra.'worldmap.jpg';
$image_pin=$dirextra.'pin.jpg';
$image_worldmap_info=getimagesize($image_worldmap);
$image_pin_info=getimagesize($image_pin);
$image_worldmap_width =$image_worldmap_info[0];
$image_worldmap_height=$image_worldmap_info[1];
$image_pin_width=$image_pin_info[0];
$image_pin_height=$image_pin_info[1];
unset($image_worldmap_info);
unset($image_pin_info);
$scale=360/$image_worldmap_width;
echo'<div id="worldmap" style="position:relative;background-image:url('.$image_worldmap.');margin:0px auto;width:'.$image_worldmap_width.'px;height:'.$image_worldmap_height.'px;border:none;">'."\n";
//<-Worldmap image
$results=array();$i=0;$i2=0;$ito=count($sgeo_a);
while($i2<=$ito){
//foreach($sgeo_a as $geolocate){
    $geolocate=$sgeo_a[$i2];
    $sqg=mysql_query('SELECT * from geolocation WHERE locId='.$geolocate);
    $sqg_c=mysql_result($sqg,0,'country');$sqg_r=mysql_result($sqg,0,'region');
    $sqg_la=mysql_result($sqg,0,'latitude');$sqg_lo=mysql_result($sqg,0,'longitude');
    $sqg_ci=mysql_result($sqg,0,'city');
    fwrite($fh,'<Placemark><name>'.$sgeo_count[$geolocate].'</name><description>'.$sqg_r.'</description>
                <Point><coordinates>'.$sqg_lo.','.$sqg_la.',0</coordinates></Point></Placemark>');
    /*if($sgeo_count[$geolocate]>1){$vis=' Visitors';}
    else{$vis=' Visitor';}*/
    $results[$i]=$sgeo_count[$geolocate].','.$sqg_c.','.$sqg_ci.' '.$sqg_r.' '.$geolocate;
    ++$i;
    //worldmap image
    
    $x=floor(($sqg_lo+180)/$scale);
    $y=floor((180-($sqg_la+99))/$scale);//180-   (90 org (must integrate margin from css)
    echo'<div style="position:absolute;top:'.$y.'px;left:'.$x.'px;"><img src="'.$image_pin.'" width="'.$image_pin_width.'" height="'.$image_pin_height.'" alt=""></div>'."\n";
    ++$i2;
}
echo'</div>';//<-end of worldmap image
fwrite($fh,'</Document></kml>');
chmod($dirextra.'kml/'.$thefile,0755);
fclose($fh);
if(isset($dirextra)){$dirextra2='/';}
$thefile='http://'.$_SERVER['SERVER_NAME'].$subdir[0].$dirextra2.$dirextra.'kml/'.$thefile;
echo'<center><a href="http://maps.google.com/maps?q='.$thefile.'">View on GoogleMap</a> <a href="'.$thefile.'">Download for GoogleEarth</a>'.NN.'<u>Visitors,Country,Location</u>'.N;
arsort($results);
foreach($results as $result){
    echo$result.N;
}

echo'</center>'.N;
$time=explode(' ',microtime());$time2_res=(float)$time[1] + (float)$time[0];
if(($uid==1)and!isset($dirextra)){require('../inc/benchmark.php');}
//.'<iframe name="middleframe" src="'.$maploc.'" width="100%" height="200" frameborder="0"></iframe>';
?>