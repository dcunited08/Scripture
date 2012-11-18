<?php # licence: gpl-signature.txt
  $time=explode(' ',microtime());$time=$time[1] + $time[0];$time1_sall=$time;$time1_all=$time;
  //$result=mysql_query_s($sql);
  $r=mysql_query_s($bsecountall);$num3=mysql_numrows($r);
  $time=explode(' ',microtime());$time=$time[1] + $time[0];$time2_all=$time;
  if($uid=1){echo$bsecountall.NN;}
  $i=0;while($i<$num3){
    $sbid=mysql_result($r,$i,'bid');
    echo'<a href="?s='.str_replace(' ','+',$regex_enabled.$se5).'&b='.$sbid.'&bk='.$book.'&ch=&#62;&#62;&c='.$chap.'">'.$sbid.' '.$bidarray[$sbid].'('.mysql_result($r,$i,'C').')</a> ';
    ++$i;
  }
  echo NN;
  $time=explode(' ',microtime());$time=$time[1] + $time[0];$time2_sall=$time;
?>