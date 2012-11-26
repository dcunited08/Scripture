<?php # licence: gpl-signature.txt

$seonly="";$sebookspecific="";$sebookmatched=""; //if html search received
if(!empty($_GET['s'])or!empty($_GET['s2'])or!empty($_GET['s3'])or!empty($bookmark)or!empty($favorite)or!empty($_POST['lookup'])or!empty($_GET['lookup'])or!empty($cross)or!empty($_GET['advs'])or(empty($setnote)and empty($setnote2)and empty($setxref)and !empty($note))){
 unset($verse,$sqverse);
 if(!empty($_GET['s'])){$se1=urldecode(stripslashes($_GET['s']));}
 elseif(!empty($_GET['s2'])){$se1=urldecode(stripslashes($_GET['s2']));}
 elseif(!empty($_GET['s3'])){$se1=urldecode(stripslashes($_GET['s3']));}
 elseif(!empty($bookmark)){$se1=$bookmark;}
 elseif(!empty($cross)){$se1=$cross;}
 elseif(!empty($favorite)){$se1=$favorite;}
 elseif(!empty($note)){$se1=$note;}
 elseif(!empty($_POST['lookup'])){$se1=urldecode(stripslashes($_POST['lookup']));}
 elseif(!empty($_GET['lookup'])){$se1=urldecode(stripslashes($_GET['lookup']));}
 elseif(!empty($_GET['advs'])){
  $se1=urldecode(stripslashes($_GET['advs']));
  $advm=stripslashes($_GET['m']);if(!empty($advm)){$se1=$advm.':'.$se1;}
  //elseif($advm == 'en'){$se1='r: ([[:space:]]|^)'.preg_replace('/(\s)/i','[[:space:]]',$se1).'[\.]?([[:space:]]?\{|$)';}
  
  //if(substr(0,1) ==='"'){}
 }
 //echo $se1; //$se=$se3;
 if(strstr($se1,'!')){$se1=str_replace('!','-',$se1);}
 
 if(strstr($se1,'/')or(strstr($se1,'\\'))){$se1=str_replace('\\','|',$se1);$se1=str_replace('/','|',$se1);}
 if(strstr($se1,'|')){if(strstr($se1,' |')or strstr($se1,'| ')){
   $se1=preg_replace('/\s{0,3}?\|\s{0,3}?/','|',$se1);}
   if(strstr($se1,'||')){$se1=str_replace('||','|',$se1);}
 }
 if(preg_match('/(^[\.]?([bseropmwt])\:)/i', $se1,$match)){$doadv=1;}
 if(!preg_match('/(\d)/',$se1)){#or(preg_match('/(\d)/',$se1)and strstr($se1,')'))
  /*
   $mysettings[19] Paraphrase Sources 1 Groups,Own,Public,Server 2 Groups,Own,Server 3 Default(Own),Server
   $mysettings[20] Paraphrase Shares 1 Everyone 2 Groups 3 Default(None)
   $mysettings[21] Paraphrase Level 1, 2, 3
  */
  //Paraphrase
  $checkcheck=$se1;
  $modetmp=$match[1];
  $semp=preg_replace('/^'.substr($modetmp,0,1).'\:\s{1,2}?/i','',$se1);
  $pase=explode(' ',$semp);$sopp="";$sopp2="";
  $pmo=$mysettings[21];
  if($pmo<=1){$paramodea='a,b,c';}
  elseif($pmo==2){$paramodea='a,b,c,d,e,f';}
  else{$paramodea='a,b,c,d,e,f,g,h,i,j';}
  $sqadd='SELECT '.$paramodea.' FROM bible_psem where uid='.$uid.' AND w=\'';
  $sqadd2='SELECT wid FROM bible_psew where w=\'';
  $sqadd3='SELECT w FROM bible_psew where wid=';
  foreach($pase as $ppart){
   $sopp=$ppart;
   if(strstr('|',$ppart)){
    $pparte=explode('|',$ppart);
    foreach($pparte as $ppartee){
     $wf=mysql_result(mysql_query_s($sqadd2.$ppartee.'\''),0,'wid');//AND lang='.$wtcl
     if(!empty($wf)){
      $r=mysql_query_s($sqadd.$wf.'\'');$num=mysql_numrows($r);
      $i=0;while($i<$num){
       if($pmo<=1){
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'a')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'b')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'c')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
       }
       elseif($pmo==2){
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'a')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'b')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'c')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'d')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'e')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'f')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
       }
       else{
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'a')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'b')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'c')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'d')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'e')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'f')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'g')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'h')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'i')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'j')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
       }
       ++$i;
      }
     }
    }
   }else{
    $wf=mysql_result(mysql_query_s($sqadd2.$ppart.'\''),0,'wid');//AND lang='.$wtcl
     if(!empty($wf)){
      $r=mysql_query_s($sqadd.$wf.'\'');$num=mysql_numrows($r);
      //echo$sqadd.$wf.'\'';
      $i=0;while($i<$num){
       if($pmo<=1){
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'a')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'b')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'c')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
       }
       elseif($pmo==2){
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'a')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'b')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'c')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'d')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'e')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'f')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
       }
       else{
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'a')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'b')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'c')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'d')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'e')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'f')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'g')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'h')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'i')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
	$tpa=mysql_result(mysql_query_s($sqadd3.mysql_result($r,$i,'j')),0,'w');if(!empty($tpa)){$sopp.='|'.$tpa;}
       }
       ++$i;
      }
     }
   }
   $sopp2.=$sopp.' ';
  }
  $se1=$sopp2;
  //if($uid==1){echo$se1.'<br>';}
 }
 if(strstr($se1,'·')){$see=explode('·',$se1);$se1=$see[1];}
 if(preg_match('/\dv\d/i',$se1)){$se1=preg_replace('/(\d{1,3})v(\d{1,3})/i','\1:\2',$se1);}
 if(substr($se1,0,1) !== '.'){$se4=$se1;$se1='.'.$se1;}
 //else {$multilangcheck='1';} //multilanguages now only for multiple verse lookups.(saves memory) or with settings
 $se3=explode('.',$se1);
 if(empty($se3[0])and !empty($se3[1])){$se3[0]=$se3[1];$se3[1]="";}
 if(strstr(substr($se4,0,1),'"')){$se4='m:'.str_replace('"',"",$se4);}
 if(isset($doadv)){require('inc/advanced_search.php');}
 if(count($se3) > 2){$nohighlight=$se1;}
 //echo'_0: '.$se3[0].' 1: '.$se3[1].' 2: '.$se3[2].' _';
 $i4='0';$searray=array();$versearray=array();
 // for multiple verses string gatherings
 foreach($se3 as $k){$se=trim($k);
       if(!empty($se)){
	//if(preg_match('/^r:/i', $se)){$se2=preg_replace('/^r:[\s]?/',"",$se);$regex_enabled='r:';}
	//else{$se2=$se;}
	$se2=$se;
	$ats=explode(' ',$se); //$sesum=sizeof($ats); //maby later
	$t_book=strtolower($ats[0]);$treetok=substr($t_book,0,3);$firtok=substr($t_book,0,4);
	$femtok=substr($t_book,0,5);if(isset($token)){unset($token);}
	if(strlen($t_book)>3){
	 if(strlen($t_book)>4){$femfo=1;}
	 $firfo=1;
	}
	elseif(($treetok=='jud')or($treetok=='fil')){$treetok=$firtok;}//$treetok=preg_match('/(jud[^\s]?)/i',$t_book);}
	if((!empty($ats[1])and is_numeric($ats[1]))or(!empty($ats[1])and strpos($ats[1],':') >= '1')or(strpos($se,'(') >= '1')){ // or preg_match('/(\d)/',$ats[1])
	  //if(!empty($multilangcheck)){ //might be used later
	  if(!isset($a_shortdrupal)){require('inc/Languages/Filter_drupal.php');}//}
	  $ia=0;foreach($a_shortdrupal as $key=>$ki){if($ki==$treetok){$token=$ia;break;}++$ia;}
	  if(empty($token)){
	   require('inc/Languages/Filter_english.php');
	   if(isset($firfo)){
	    if(isset($femfo)){$ia=0;foreach($a_books as $key=>$ki){if($ki==$femtok){$token=$ia;break;}++$ia;}}
	    if(empty($token)){$ia=0;foreach($a_books as $key=>$ki){if($ki==$firtok){$token=$ia;break;}++$ia;}}
	    }
	   if(empty($token)){$ia=0;foreach($a_books as $key=>$ki){if($ki==$treetok){$token=$ia;break;}++$ia;}}
	  }
	  if($l=='ru'){
	   if(!isset($a_rubok)){require('inc/Languages/Filter_russian.php');}
	   if(isset($firfo)){
	    $ia=0;foreach($a_rubok as $key=>$ki){if($ki==$firtok){$token=$ia;break;}++$ia;}
	   }
	   if(empty($token)){$ia=0;foreach($a_rubok as $key=>$ki){if($ki==$treetok){$token=$ia;break;}++$ia;}}
	  }
	  if(empty($token)){
	   if(!isset($a_shortdrupal)){require('inc/Languages/Filter_norwegian.php');}
	   if(isset($firfo)){
	    if(isset($femfo)){$ia=0;foreach($a_bokers as $key=>$ki){if($ki==$femtok){$token=$ia;break;}++$ia;}}
	    if(empty($token)){$ia=0;foreach($a_bokers as $key=>$ki){if($ki==$firtok){$token=$ia;break;}++$ia;}}
	   }
	   if(empty($token)){$ia=0;foreach($a_bokers as $key=>$ki){if($ki==$treetok){$token=$ia;break;}++$ia;}}
	  }
	  if(empty($token)and!empty($a_dbbooksorg)){
	   $ia=0;foreach($a_dbbooksorg as $key=>$ki){if($ki==$treetok){$token=$ia;break;}++$ia;}
	  }
	  if(empty($token)){
	   if(!isset($a_sword)){require('inc/Languages/Filter_sword.php');}
	   $totok=substr($t_book,0,2);
	   if(isset($firfo)){
	    $ia=0;foreach($a_sword as $key=>$ki){if($ki==$firtok){$token=$ia;break;}++$ia;}
	   }
	   if(empty($token)){$ia=0;foreach($a_sword as $key=>$ki){if($ki==$treetok){$token=$ia;break;}++$ia;}}
	   if(empty($token)){$ia=0;foreach($a_sword as $key=>$ki){if($ki==$totok){$token=$ia;break;}++$ia;}}
	  }
	  if(!empty($token)){$b_name=$a_shortdrupal[$token];}
	  if(!empty($b_name)){$book=$b_name;}else{$book=$t_book;$nobook='1';}
	}
	unset($a_shortdrupal,$a_books,$a_bokers,$a_dbbooksorg,$a_rubok);
	if(preg_match('/\d{1,4}\:\d{1,4}/',$ats[1])and!isset($nobook)){
	  //echo $book." ".$sesum."<br>";
	  $temp_nums=explode(":",$ats[1]);
	  if(isset($ats[2])and isset($_GET['bookmark'])){$bookmarkid=$ats[2];}
	  if(isset($temp_nums[1])){
	   if(strstr($temp_nums[1],',')){
	    $mve=explode(',',$temp_nums[1]);
	    $vermulti=' in(';foreach($mve as $mv){
	     if(!strstr($mv,'-')){
	      if(!isset($versenum)){$versenum=$mv;$vermulti.=$mv;}else{$vermulti.=','.$mv;}}
	     else{
	      $mve2=explode('-',$mv);
	      $i5=$mve2[0];while($i5<=$mve2[1]){if(!isset($versenum)){$versenum=$i5;$vermulti.=$i5;}else{$vermulti.=','.$i5;}}++$i5;
	     }
	    }$vermulti.=') ';
	   }else{$versenum=$temp_nums[1];}
	  }
	  $chap=$temp_nums[0];$verse=$versenum;$se="";$highlightv='↓';
	  if(strstr($verse,'-')){$verse=explode('-',$verse);$vtop=$verse[1];$verse=$verse[0];}//add multiple in the future
	  if(strstr($chap,'-')){$chap=explode('-',$chap);$mchap=' BETWEEN '.$chap[0].' AND '.$chap[1].' ';}
	}elseif(!is_numeric($ats[1])){$se=$se2;$se5=$se2;$seonly ='1';} // checks if search, so it don't get books (needs some improvement?) //old: !preg_match('/(\d)/',
	//elseif(!empty($ats[1]) && !isset($nobook)){$se="";} // nessesary? needs some tweak
	elseif(preg_match('/\w{1,20}\s\d{1,4}/',$se) && !isset($nobook)){$chap=$ats[1];$highlightv='↓';}else{$seonly='1';}
	if(preg_match('/\w{1,4}\(\d{1,5}\)/i',$se,$sebookmatch)){ //check if bookspecific search
	  $se5=preg_replace('/\s\w{1,3}\(\d{1,5}\)/i',"",$se);
	  $book=preg_replace('/\(\d{1,5}\)/i',"",$sebookmatch[0]);
	  if(!isset($_GET['all'])){$sebookmatched=' AND book=\''.$book.'\'';$bookspecific='1';}
	}elseif(preg_match('/\w{1,4}\(\)/i',$se,$sebookmatch)){
	  $se5=preg_replace('/\s\w{1,3}\(\)/i',"",$se);
	  $book=preg_replace('/\(\)/i',"",$sebookmatch[0]);
	  if(!isset($_GET['all'])){$sebookmatched=' AND book=\''.$book.'\' ';$bookspecific='1';}
	}else{$nobookspecific='1';}
	if(empty($nobook)&&empty($seonly)&&empty($versenum) && preg_match('/(\d)/',$ats[1])){
	  $chaps=$ats[1];$se="";
	  if($chaps !== $chap){$chap=$chaps;$chapdiff='1';} $checkchap=1; // this also need reconsideration with the html referer
	} elseif(preg_match('/(\d)/',$ats[1])and!empty($nobook)){$book=$ats[0];$chap=$ats[1];}
	if(isset($checkchap)){if(strstr($ats[1],'-')){$chapt=explode('-',$ats[1]);$mchap=' BETWEEN '.$chapt[0].' AND '.$chapt[1].' ';}}
	if($book == 'psa'){$book='ps';}
	$book=strtoupper($book);//echo'_'.$book.' '.$chap.' '.$se.' _<br>';
	if($i4 != '0'){$versearray[$i4]=' or ';$bookspecific='1';} else {$versearray[$i4]="";}
	if(!isset($vermulti)){if(!empty($vtop)){$sqverse=' verse BETWEEN '.$verse.' AND '.$vtop; unset($vtop);}else{$sqverse=' verse='.$verse;}}
	else{$sqverse=' verse'.$vermulti;}
	if(!empty($mchap)){$dochap=$mchap;}else{$dochap='='.$chap;}
	$versearray[$i4].='(book=\''.$book.'\' and chapter'.$dochap.' and '.$sqverse.')';
	++$i4;
       }
     }
     if(!empty($nohighlight)){ unset($highlightv);}
}else{$se="";}// <- if html search received
if(empty($se5)and!empty($se)){$se5=$se;}
if(isset($chapdiff)){ if($chapdiff !== $chap){$chap=$chaps;} } //  && !strpos($_SERVER['HTTP_REFERER'], "s=")
//if(isset($_SERVER['HTTP_REFERER']) && empty($chbf)){ if(!strpos($_SERVER['HTTP_REFERER'], "bk=$book") && empty($chapdiff)){$chap ='1';} } // need some fix sometime
if(isset($_SERVER['HTTP_REFERER']) && empty($chbf)){ if(empty($chap) && empty($chapdiff)){$chap ='1';} }
#wbid add from if downunder
 if(empty($ismultib)){ if($b != '*'){$w .= $b;} }
  else{foreach($ismultib as $multib){// Interlinear bible function
      $multib=trim($multib);
      if(empty($w)){$w=$multib;}else{$w .= ' '.$multib;}
      $bs .= '|'.$multib.'|'; //For the translator function
    }
    $w=preg_replace('/\s/',', ',$w);
  }
  if(!strstr($w.$b,'all')){
  if(strstr($w,',')){
   $w=' IN('.$w.') ';
   $wbid=' bid '.$w;}else{$wbid='bid='.$w;$w='=\''.$w.'\'';}
  
  }else{$wbid='1';$w="";$extraver=1;}
if(empty($seonly) and empty($nobook)){$w="";$bs="";
  if(!empty($mchap)){$dochap=$mchap;$dovsid='vsid,';}else{$dochap='='.$chap;}
  if(empty($versearray[1])){
   $mapspecific='1';if(isset($vermulti)){$vermultis=' and verse '.$vermulti;}
   $bse='SELECT  max(rev),revuid,revdate,bid,book,chapter,verse,context,vsid,mode FROM '.$database.'.bible_context WHERE '.$wbid.' AND book=\''.$book.'\' and chapter'.$dochap.$vermultis.' group by bid,book,chapter,verse ORDER BY '.$dovsid.'verse,bid';
  }// AND linemark<>\'*\'
  else {$bse='SELECT  max(rev),revuid,revdate,bid,book,chapter,verse,context,vsid,mode FROM '.$database.'.bible_context WHERE '.$wbid.' AND (';
    foreach($versearray as $k){$bse .= $k;}
    $bse .= ') group by bid,book,chapter,verse ORDER BY book,vsid';$fullreference='1'; // AND linemark<>\'*\'
  }
}else{if(isset($regex_enabled)){ // STRING SEARCH (regexp function disabled)
    //$w .= ' AND context REGEXP \''.$se.'\'';
    //$kwlist=array($se);
}else{$kwl=explode(' ',stripslashes($se5));$w2 ="";$w="";
    // str_replace(array('Æ','Ø','Å'),array('æ','ø','å'), // new system now uses htmlentities on import of bibles; this may cause some errors to old databases. and ones used with drupal. make solution to this?
    //$w .= " UPPER(context) LIKE '%".strtoupper($kw)."%'";
    foreach($kwl as $kw){
      $kw=trim($kw);
      if($kw == ""){continue;}
      if(!empty($w)or!empty($w2)){$w .= ' AND';$w2 .= ' AND';}
      if(substr($kw, 0, 1) == '-'){$w .=' NOT';$w2 .=' NOT';$kw=substr($kw, 1);}
      if(strstr($kw,'|')){
       $kw2=explode('|',$kw);
       $w .= ' (';$w2 .= ' (';
       $kw2c=count($kw2);$ikw=1;
       foreach($kw2 as $kwp){
	$w .= ' context LIKE \'%'.htmlentities($kwp,ENT_QUOTES,'UTF-8').'%\'';
	$w2 .= ' context LIKE \'%'.$kwp.'%\'';$kwlist[]=$kwp;
	if($ikw<$kw2c){$w.=' OR';$w2.=' OR';}++$ikw;
       }$w .= ')';$w2 .= ')';
      }
      else{
       $w .= ' context LIKE \'%'.htmlentities($kw,ENT_QUOTES,'UTF-8').'%\''; //mb_strtoupper($kw,'UTF-8') //not really needed
       $w2 .= ' context LIKE \'%'.$kw.'%\'';$kwlist[]=$kw;
      }
    }
  }
  if(strlen($w2) > 3){$w3=' OR (mode is NULL AND '.$w2.')';}
  $w='((mode=2 AND '.$w.')'.$w3.')';
  
  $bsecountall='SELECT '.$sqextra.'bid,count(*) AS C FROM '.$database.'.bible_context WHERE '.$w.' and '.$wbid.' group by bid ORDER BY bid;';
  #if(empty($ismultib)){if(($b != '*')and($b != 'all')){$w .= ' AND bid=\''.$b.'\' ';}} ##not used anymore__
  #elseif($b != 'all'){$k=array_keys($ismultib);$sz=sizeOf($k);$w.=' AND (';for($nu=0;$nu<$sz;++$nu){if($nu!==0){$w.=' OR ';}$w.='(bid='.$ismultib[$k[$nu]].')';}$w.=') ';}
  $bse='SELECT max(rev),revuid,revdate,bid,book,chapter,verse,context,vsid,mode FROM '.$database.'.bible_context WHERE '.$wbid.' and '.$w.' '.$sebookmatched.' group by bid,book,chapter,verse ORDER BY vsid,bid;';// AND linemark<>\'*\'
  $bsecount='SELECT book,count(book) AS C FROM '.$database.'.bible_context WHERE '.$w.' and '.$wbid.' group by book ORDER BY vsid;';// AND linemark<>\'*\'
  $bsecountadv='SELECT '.$sqextra.'bid FROM '.$database.'.bible_context WHERE '.$w.' and '.$wbid.' ORDER BY vsid;';
}

#if($uid==1){echo 'bse: '.htmlentities($bse).N.'bsecountall: '.htmlentities($bsecountall);}
#if($uid==1){echo htmlentities($bse).' bible: '.$b.' token:'.$tokentemp.N;} //preg_replace(array('/\s/','/\:/'),array('/\%20/','/\%3A/')
# licence: gpl-signature.txt?>