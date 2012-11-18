<?php // licence: gpl-signature.txt
//($modedisplaydata==='1')
//echo'<meta http-equiv="Refresh" content="1; url='.$pageURL.'&pos=1&#v">';

$memory_usage = explode('.',((memory_get_usage() - $memory_start) / 1024));
$time = explode(' ', microtime());
$total_time = round((($time[1] + $time[0]) - $start)*1000);
$ttperc=($total_time / 100);
if (empty($obgetlenght)){$obgetlenght=ob_get_length();}
  $kBs = Round((($obgetlenght/$total_time))/8);
  //$transfer = Round(($obgetlenght/1024)/8); //".$transfer."kB";
  $cpu = round(($memory_usage[0]/$total_time)); // $time1_res $time1_resnum $time1_all
  echo'in '.$total_time.'ms '. // Please tell others about it(this is not a human law required to keep), the same regards the domate button.
  'Mem: '.$memory_usage[0].'kB bData: '.$kBs.'kB/s PHP: '.$cpu.
  'MB/s MySQL: sA '.round((($time2_all - $time1_all) * 1000)/$ttperc).
  '% sN '.round((($time2_resnum - $time1_resnum) * 1000)/$ttperc).
  '% Bdata '.round((($time2_res - $time1_res) * 1000)/$ttperc).
  '%: sA: '.round((($time2_sall - $time1_sall) * 1000)/$ttperc).
  '% Bparser: '.round((($time2_b - $time1_b) * 1000)/$ttperc).
  '% '.round(($obgetlenght / 1024) / 8).
  'kB init.php: '.round((($time_init - $start) * 1000)/$ttperc).
  '% parsefilter.php: '.round((($end_pf - $start_pf) * 1000)/$ttperc).
  '% index.php: '.round((($end_in - $end_pf) * 1000)/$ttperc).'%'; // $_SERVER['QUERY_STRING']
  //'% theme_loader.php: '.round((($themel_e - $themel_s) * 1000)/$ttperc). //theme_loader
//"<a href=".$_SERVER['PHP_SELF']."?s=".preg_replace('/\s/','+',$se)."&b=".$b."&bk=".$book."&c=".$chap.">".$sqlcountbook."(".$sqlcountversenum.")</a>"
?>