<?php # licence: gpl-signature.txt
$r=mysql_query_s('SELECT * FROM '.$database.'.bible_list order by bid ASC');$num=mysql_numrows($r);
//echo'<input type="text" name="s" value="'.$regex_enabled.$nohighlight.$se.'">';
if(isset($largelist)or(isset($_GET['largelist']))){
 if(isset($_GET['largelist'])){$largelist=1;}
 $r=mysql_query_s('SELECT * FROM '.$database.'.bible_list order by lang,bname ASC');$num=mysql_numrows($r);
 echo'<form action="bible_dial.php" method="get"><input type="hidden" name="bd"><select name="b">';
 require('Language_codes.php');
}
elseif(!empty($tools)or isset($ismultib)){echo'<select name="b[]" MULTIPLE SIZE=3>';}
else{echo'<select name="b" style="width:104">';}
$bidarray=array();$totranslate=array();
$i=0;while($i<$num){
 $bid=mysql_result($r,$i,'bid');$bsn=mysql_result($r,$i,'bsn');$bname=mysql_result($r,$i,'bname');
 $lang=mysql_result($r,$i,'lang');$suids=mysql_result($r,$i,'uids');$sglobal=mysql_result($r,$i,'global');$sowner=mysql_result($r,$i,'owner');
 if(preg_match('/(,|^)'.$bid.'(,|$)/',$mysettings[22])){$nobshow=1;}
  if(isset($largelist)and!isset($nobshow)){
   if($lang!=$tmplang){
    //$token_lang=array_search('|'.$lang,$a_lcode);
    //if($token_lang!==''){$token_lang=explode('|',$a_lcode[$token_lang]);}
    //else{$token_lang[0]=$lang;}
    if(!empty($a_lcodes[$lang])){$token_lang=$a_lcodes[$lang];}
    else{$token_lang=$lang;}
    echo"<option value='0'> -".$token_lang."</option>";
    $tmplang=$lang;
   }
  }
  if(!isset($nobshow)){
  if(empty($sglobal)or($sglobal=='1')or($uid===$sowner)or($suids===$uid)or($uid==='1')or(preg_match('/(^'.$uid.'\s)|(\s'.$uid.'\s)|(\s'.$uid.'$)/i',$suids))){
    if($lang=='GRK'){$totranslate[$i]=$bid;} //Translation function:
    if(preg_match('/strong/i',$bname)){if(isset($strongblist)){$strongblist .= ' '.$bid;}else{$strongblist=$bid;} }
    if(empty($b)){// && ($u == 'demo'))
      if(!empty($gbible)and($gbible == $bid)){$b=$bid;}
      if(empty($gbible)&&preg_match('/KJaV/i',$bname)){$b=$bid;} // Setting default demo bible using bible name note: make setting?
    }
    $bidarray[$bid]=$bname;
    if(!empty($ismultib)&&in_array($bid,$ismultib)){$ssbible2=' selected';}
    elseif($b===$bid){$ssbible2= ' selected';$a_b='';}else{unset($ssbible2);}
    echo "<option value='$bid' name='$bsn'$ssbible2>$bname"."[".$bid."]</option>"; // bsn $bsn lang $lang 
  } elseif($b===$bid){die('Access denied or no scripture found.');} //scripture-security
  if($b==='all'){$ssbible2=' selected';}else{$ssbible2="";}
  }else{unset($nobshow);}
  ++$i;
}
if(!isset($notallbibles)and!isset($largelist)){echo'<option value="all"'.$ssbible2.'>Search all Bibles</option>';}
echo'</select>';
if(isset($largelist)and($largelist !== '2')){echo'<input type="submit" value="Go"></form>';}
?>