<?php # licence: gpl-signature.txt
$time=explode(' ',microtime());$time1_b=$time[1] + $time[0];
if(empty($versehighlightcolor)){$versehighlightcolor="blue";}
if(isset($doeditb)){
  //$c_edits='';
  $c_edits=mysql_result(mysql_query_s('Select chap from bible_book_name where bid=1 AND book=\''.$book.'\''),0,'chap');
  $checkifexist=mysql_result(mysql_query_s('Select context from bible_context where bid='.$doeditb.' AND book='.$bk),0,'context');
  if(empty($checkifexist)){$noneexistent='1';$no_data_count='';}
}
if(!empty($mysettings[3])and empty($seonly)and empty($highlightv)and empty($bookspecific)and($mysettings[3] < '3')and!empty($removethis)){
  $parse_mode=$mysettings[3];
  $cachefile='cache/'.$parse_mode.'/'.$bdir.'_'.$b.'/'.$book.'_'.$chap.'.html';
  if(!file_exists($cachefile)){
    $cachefilego='1';
    if(!file_exists('cache')){mkdir('cache');}
    if(!file_exists('cache/'.$parse_mode)){mkdir('cache/'.$parse_mode);}
    if(!file_exists('cache/'.$parse_mode.'/'.$bdir.'_'.$b)){mkdir('cache/'.$parse_mode.'/'.$bdir.'_'.$b);}
  }
 }
 if(!empty($parse_mode)and isset($cachefilego)){include($cachefile);}
 else{
    //if(!empty($dotranslate)){ echo "<select style=\"width:65\" name=\"strongbox\">";} // old
  if(!empty($strongblist)){
    if(!empty($ismultib)){
      if(!isset($strongblist[1])){$strongblist=explode(' ',$strongblist);}
      foreach($strongblist as$strongbsearch){if(array_search($strongbsearch,$ismultib,TRUE)){$parse_strongb='1';} }
    }
    elseif(($strongblist == $b)or preg_match('/(^'.preg_quote($b,'/').'\s)|(\s'.preg_quote($b,'/').'\s)|(\s'.preg_quote($b,'/').'$)/',$strongblist)){$parse_strongb='1';}
    if(!empty($parse_mode)and!empty($parse_strongb)){ob_start();unset($highlightv,$highlightv2);} //cache-
    //".preg_quote($b,"/")."
  }
  // strong links
  // For the Translate function
  if($mysettings[3] == '1'){
    foreach($totranslate as$bcheck){if($bcheck == $bs){$dotranslate='1';$parse_strongb='1'; break;} }
    if(!empty($dotranslate)){echo'<form action="" method="post" enctype="multipart/form-data">';  }
  }
  $time=explode(' ',microtime());$time1_res=(float)$time[1] + (float)$time[0];
  if(empty($fp)){if(isset($_POST['bibleedit'])){require('inc/bibleedit.php');}$s=mysql_query_s($bse) or die(mysql_error());}else{$s="";}$num5=mysql_numrows($s);
  $snote=mysql_query_s('select v from bible_notes where b=\''.$book.'\' and c='.$chap.' and uid='.$uid);
  $numnote=mysql_numrows($snote);
  if($numnote>0){$vnotea=array();$donotec=1;$i=0;while($i<=$numnote){$vnotea[mysql_result($snote,$i,'v')]=1;++$i;}}
  $snote=mysql_query_s('select v from bible_favorites where b=\''.$book.'\' and c='.$chap.' and uid='.$uid);
  $numnote="";$numnote=mysql_numrows($snote);
  if($numnote>0){$vfavea=array();$dofavec=1;$i=0;while($i<=$numnote){$vfavea[mysql_result($snote,$i,'v')]=1;++$i;}}
  $snote=mysql_query_s('select v from bible_bookmarks where b=\''.$book.'\' and c='.$chap.' and uid='.$uid);
  $numnote="";$numnote=mysql_numrows($snote);
  if($numnote>0){$vbmea=array();$dobmcol=1;$i=0;while($i<=$numnote){$vbmea[mysql_result($snote,$i,'v')]=1;++$i;}}
  $snote=mysql_query_s('select v from bible_xrefs where b=\''.$book.'\' and c='.$chap.' and uid='.$uid);
  $numnote="";$numnote=mysql_numrows($snote);
  if($numnote>0){$vxrefea=array();$doxrefec=1;$i=0;while($i<=$numnote){$vxrefea[mysql_result($snote,$i,'v')]=1;++$i;}}
  $topvmode=$mysettings[24];if(empty($topvmode)){$topvmode=1;}
  $snote=mysql_query_s('select v from bible_topic_link where b=\''.$book.'\' and c='.$chap.' and mid=7 and ((mode=1 and uid=1)or(mode='.$topvmode.'))'); #and uid='.$uid
  $numnote="";$numnote=mysql_numrows($snote);
  if($numnote>0){$vtoea=array();$dotoec=1;$i=0;while($i<=$numnote){$vtoea[mysql_result($snote,$i,'v')]=1;++$i;}}
  
  $time=explode(' ',microtime());$time2_res=(float)$time[1] + (float)$time[0];
  if(isset($_GET['bdial'])){$bdialnum=round($num5 / 2 - ($num5 / 5));}
  #if(($uid==1)and isset($_GET['all'])){echo htmlentities($bse);}
  $checkverses=mysql_result($s,0,'context').mysql_result($s,1,'context').mysql_result($s,2,'context');
  if(empty($parse_strongb)and((count(explode('&gt;',$checkverses))>4)or(count(explode('<',$checkverses))>4))){$parse_strongb='1';}
  $clg=count(explode('{',$checkverses));
  if(preg_match('/\d{2}/',$b)){$multihelp2='1';}
  if(empty($lann)and($clg>4)){$lann='1';}
  if(empty($geneva)and($clg>1)and($clg<5)){$geneva='1';}
  if($uid==0){$dosspaced='1';}
  elseif(($mysettings[2]=='3')or empty($mysettings[2])){$spacer=N;} //2 Verse Modes v_dmode 1 Compact 2 Extra Spaced 3 Default(Spaced)
  else{$dosspaced='1';}//elseif($mysettings[2]=='2'){$dosspaced='1';}
  //echo htmlentities(htmlentities('>'));
  //if(isset($regex_enabled)){$reg_ena=urlencode('r:');}//regexp disabled
  if(!empty($parse_strongb)and!empty($parse_mode)){unset($highlightv);$nohighlight='1';}//used when caches
  if(isset($simplified_mode)){
    $seadva=$sr;
    $results_regex=array();
    $i=0;while($i<$num5){
      $sc=mysql_result($s,$i,'context');
      //echo'/'.$sr.'/i'.N.$sc.N;
      if($i>1000){echo'Limit Exceeded; Please Specify Your Search Better.'.NN;break;}
      if(preg_match('/'.$sr.'/i',$sc)){
	//echo'working';
	//$sqlbid=mysql_result($s,$i,'bid');
	$schap=mysql_result($s,$i,'chapter');
	$v=mysql_result($s,$i,'verse');
	$s_bk=mysql_result($s,$i,'book');
	$results_regex[$s_bk.'_'.$schap.'_'.$v]='1';
      }
      ++$i;
    }
  }
  $x="";$i=0;while($i<$num5){
    $sqlbid=mysql_result($s,$i,'bid');$schap=mysql_result($s,$i,'chapter');$v=mysql_result($s,$i,'verse');$s_bk=mysql_result($s,$i,'book');
    if(isset($simplified_mode)){
      if(empty($results_regex[$s_bk.'_'.$schap.'_'.$v])){++$i;continue;}
    }
    if(!empty($ismultib)or isset($extraver)){
      if(isset($multihelp2)and($v>1)){$multihelp2=str_repeat('&nbsp;',(2-strlen($sqlbid)));}
      $multihelp='|'.$sqlbid.$multihelp2;
    }
    $l=$v.$multihelp;
    $lall=$s_bk.' '.$schap.':'.$v;
    if(empty($seonly)){
      $sc=mysql_result($s,$i,'context');
      $scl=strlen($sc);
      if((strpos($sc,'[')<3)and strstr($sc,'[')and($sqlbid!=$doeditb)){
	$sp1=strpos($sc,'[');$sp2=strpos($sc,']')-$sp1;
	$scm=substr($sc,$sp1,$sp2);
	$sc=str_replace($scm.']','<font color="'.$tocol.'">'.$scm.']</font>',$sc);
      }elseif(strpos($sc,'&')<3){}
      if(strstr($sc,'{')and($sqlbid!=$doeditb)){
	  $dxt=strpos($sc,'{');
	  $scm=substr($sc,$dxt,$scl);
	  $sc=str_replace($scm,'<font color="'.$notcol.'">'.$scm.'</font>',$sc);
      }
    }
    if(!empty($seonly)){
      if(empty($kwl)){$kwl=$kwlist;}
	$sc=mysql_result($s,$i,'context');
	foreach($kwl as $kw){
	  $kw=trim($kw);
	  if(preg_match('/\d{4}/',$kw)){
	    if(preg_match('/^\d{4}$/',$kw)){$dhelp='\w';}
	    # is this ok?
	    $sc=preg_replace('/&lt;?('.$dhelp.htmlentities($kw).')&gt;?|<?('.$dhelp.$kw.')>?/i','<a href="?uf=1&b='.$b.'&gs=\1\2'.$scrolll.'"><u>\1\2</u></a>',$sc);
	  }else{
	    $sc=preg_replace('/(('.htmlentities($kw).')|('.$kw.'))/i','<zx>\1</zx>',$sc);
	    #if($uid=1){$sc.='_'.$kw.'_';}
	  }
	}
    }
    elseif(!empty($highlightv)&&empty($bookspecific)&&empty($nohighlight)){//verse highlighter //<font color="'.$versehighlightcolor.'"> //</font>
      if($v===$verse){$l=$lall;$direction=' id="v" ';}
      elseif(!empty($direction)){unset($direction);}//<a href="?uf=1&b='.$b.'&gs=\3">\1</a>
      if((($v <= $vtop)and($v >= $verse))or($verse == $v)){if(empty($highlightv2)and($sqlbid!=$doeditb)){$highlightv='<font color="'.$versehighlightcolor.'"><u>';$highlightv2='</u></font>';} }
      elseif(($v > $vtop)and($v > $verse)){unset($highlightv,$highlightv2);}
    }
    elseif(($v==='1')&&empty($seonly)){$l=$lall;}
    if(!empty($bookspecific)or isset($_GET['all'])){$l=$lall;$l2='<a href="?s='.urlencode($lall).'&b='.$sqlbid.'"'.$direction.'>»</a>';}//ʌΛ» // && empty($parse_strongb)
    elseif(!empty($fullreference)&&empty($nohighlight)){$l=$lall;} //$l=$s_bk." ".$schap.":".$v; //to implement modes for the verse ref display
    #bmcol,#favcol
 
    if(isset($donotec)and!empty($vnotea[$v])){$notcolor=' class="notcol" ';}
    elseif(isset($doxrefec)and!empty($vxrefea[$v])){$notcolor=' class="xrefcol" ';}
    elseif(isset($dofavec)and!empty($vfavea[$v])){$notcolor=' class="favcol" ';}
    elseif(isset($dobmcol)and!empty($vbmea[$v])){$notcolor=' class="bmcol" ';}
    elseif(isset($vtoea)and!empty($vtoea[$v])){$notcolor=' class="tocol" ';}
    elseif(isset($notcolor)){unset($notcolor);}
    
    $l='<a '.$notcolor.'href="?uf='.urlencode($lall).'&b='.$sqlbid.$scrolll.'"'.$direction.'>'.$l.'</a>'; // old target: middleframe
    if(!empty($bdialnum)){
      if($v==$bdialnum){$direction=' id="v" ';}
      elseif(!empty($direction)){unset($direction);}  
    }
      if(!empty($sebookmatched)){
	if(empty($seonly)){
	  $l3='<a href="?b='.$sqlbid.'&bk='.$s_bk.'&ch=&#62;&#62;&c='.($schap - 1).$scrolll.'"'.$direction.'>';}
	  $x.=$l3.$l2.' '.$l.'</a> '.$sc.N;
      }else{
	if(isset($doeditb)and($doeditb==$sqlbid)){
	  $vtmp=$v;++$no_data_count;
	  $bed1='<input type="text" SIZE="180" name="'.$s_bk.'_'.$schap.'_'.$v.'" value="';$bed2='">';
	  $sc=str_replace('<','&lt;',$sc);
	  $sc=str_replace('>','&gt;',$sc);
	  $no_stro=1;
	}//++$c_edits;
	elseif(isset($noneexistent)){
	  if(isset($bed1)){unset($bed1,$bed2);}
	  if(!isset($tempeditbid)){$tempeditbid=$sqlbid;}
	  if(($no_data_count<=$c_edits)and($tempeditbid==$sqlbid)and($v!=$vtmp)){
	    ++$no_data_count;$vtmp=$v;
	    $checkifverseexist=mysql_result(mysql_query_s('SELECT vsid FROM bible_context WHERE bid='.$doeditb.' and book=\''.$s_bk.'\' and chapter='.$schap.' and verse='.$v),0,'vsid');
	    if(empty($checkifverseexist)){$bed3=N.$v.'|'.$doeditb.'<input type="text" SIZE="180" name="'.$s_bk.'_'.$schap.'_'.$v.'" value="';$bed4='">';}
	  }else{unset($bed3,$bed4);}
	}
	elseif(isset($doeditb)){unset($bed1,$bed2,$bed3,$bed4);}
	if(isset($dosspaced)){
	  if(!isset($btmp)and($v=='2')){$btmp=$sqlbid;}
	  else{$btmp2=$sqlbid;}
	  if(!isset($spacer3)){if($btmp2!==$sqlbid){$spacer3='1';}}
	  if(($btmp==$sqlbid)and isset($spacer3)and!isset($_GET['all'])){$spacer2=NN;}
	  else{$spacer2=N;}
	  if($i==0){$spacer2="";}
	}
	if(!empty($bfonts[$sqlbid])){if($bfonts[$sqlbid]==1){$extrafont1='<zxx>';$extrafont2='</zxx>';}}
	elseif(isset($extrafont1)){unset($extrafont1,$extrafont2);}
	##$x.=$l2.' '.$l.' '.$highlightv.'.b1:'.$bed1.'.sc:'.$sc.'.b3:'.$bed3.'.b4:'.$bed4.'.b2:'.$bed2.$highlightv2.$spacer.$spacer2;}
	$x.=$spacer2.$l2.' '.$l.' '.$extrafont1.$bed1.$highlightv.$sc.$highlightv2.$bed2.$bed3.$bed4.$extrafont2.$spacer;}
	if(isset($doeditb)){unset($bed1,$bed2,$bed3,$bed4);}
    ++$i;
 }
 if(isset($parse_strongb)and!isset($no_stro)){require('parsestrongs.php');} // <- strong links
 if(isset($no_stro)){unset($no_stro);}
 if(isset($doeditb)and!isset($fp)){$bed5='<form action="index.php?'.$bl.'&bk='.$book.'&chap='.$chap.'&c='.$chap.'&cedits='.$c_edits.'" method="post"><input type="hidden" name="bibleedit">';$bed6='Revision information: <input type="text" name="revinfo"><input type="submit" value="Save Changes"></form>';}
 echo$bed5.$x.$bed6; //prints all the bible content with one echo.
 if(isset($getstrongi)){unset($x,$strdef2,$getstrongi3,$getstrongi);}//to save memory
 elseif(!empty($x)){unset($x);}
  if(!empty($dotranslate)){echo'<input type="hidden" name="tools" value="1"><input type="hidden" name="mydata" value="5"><input type="submit" value="Save Settings"></form>'.N;} //for the translator function
 
  require('parsemapaudio.php');
  if(!empty($parse_mode)&&!empty($parse_strongb)){
     $ob_content=ob_get_contents();$obgetlenght=count_chars($ob_content);//for the cache function
     if($obgetlenght > 4){$fp=fopen($cachefile,'w');fwrite($fp,'<meta http-equiv="Content-Type"content="text/html;charset=utf-8">'.$ob_content);fclose($fp);}//ob_end_flush();
  }
 }
 $time=explode(' ',microtime());$time2_b=$time[1] + $time[0];
?>