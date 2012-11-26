<?php # licence: gpl-signature.txt
  //if(isset($regex_enabled)){$reg_ena=urslencode('r:');} //regexp disabled
  if(isset($simplified_mode)){$bsecount=$bsecountadv;}
  $time=explode(' ',microtime());$time=$time[1] + $time[0];$time1_resnum=$time;
  $r2=mysql_query($bsecount);
  $time=explode(' ',microtime());$time=$time[1] + $time[0];$time2_resnum=$time;
  $num4=mysql_numrows($r2);
  if(isset($simplified_mode)){
    //echo$num4.' activated '.$sr.N.$bsecountadv.NN;
    $results_regex=array();
    $i=0;while($i<$num4){
      if(preg_match('/'.$sr.'/i',mysql_result($r2,$i,'context'))){
	//$sqlbid=mysql_result($r2,$i,'bid');
	//$schap=mysql_result($r2,$i,'chapter');
	//$v=mysql_result($r2,$i,'verse');
	$s_bk=mysql_result($r2,$i,'book');
        //echo $s_bk.' '.$schap.':'.$v.N;
        $results_regex[$s_bk] = $results_regex[$s_bk] + 1;
      }
      ++$i;
    }
  }
  if($num4==0){echo'No Results';
    if($uid==1){
      $r2=mysql_query($bsecount);
      echo '('.$bsecount.') '.mysql_numrows($r2).$num4.mysql_result($r2,0,'book').N; print_r(mysql_fetch_row($r2));
    }
  }
  else{
  $i=0;while($i<$num4){
    $sbk=mysql_result($r2,$i,'book');
    if(!empty($simplified_mode)){
      if(empty($results_regex[$sbk])){++$i;continue;}
      $scnum=$results_regex[$sbk];
      if($sbk==$sbktmp){++$i;continue;}
      else{$sbktmp=$sbk;}
    }else{$scnum=mysql_result($r2,$i,'C');}
    $bkts=strtolower($sbk);unset($token);$ia=0;foreach($a_shortdrupal as $key=>$ki){if($ki==$bkts){$token=$ia;break;}++$ia;}
    if(empty($newlinebookfound)){if(($sbk==='MAT')or($token >= '39')){echo N;$newlinebookfound='1';}}
    echo'<a href="?s='.$reg_ena.urlencode($se5).'+'.$sbk.'('.$scnum.')&b='.$b.'&bk='.$book.'&c='.$chap.$dowl.$optw.$wcu.'">'.$sbk.'('.$scnum.')</a> ';
    ++$i;
  }}
  echo NN;
  if(empty($bookspecific)and!isset($_GET['all'])and($simplified_mode!=='r')){echo'<u>Search for this in</u><br><a href="?&lookups=1&stse='.$reg_ena.urlencode($se5).'">Strongs</a>| <a href="?&lookups=1&sf='.$reg_ena.urlencode($se5).'">Forum</a>| <a href="?&lookups=1&st='.$reg_ena.urlencode($se5).'">Topics</a>|'.N;}
  if(isset($simplified_mode)){echo'<p><a href="advanced_search.php?advs='.urlencode($sr).'&advsn='.urlencode($advsno).'&s='.$bl.$dowl.$doop.'&bk='.$s_bk.$mover.'&c='.$chap.'">Search for this between Verses, Chapters or Books</a></p>';}
?>