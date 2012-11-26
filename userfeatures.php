<?php # licence: gpl-signature.txt
if(empty($u)){require('init.php');}
if(empty($userfeatures)){if(!empty($setnote2)){$userfeatures=$setnote2;}}
require('parsefilter.php');
if(!empty($getstrong)) {
  //SELECT * FROM bible_strongnumber WHERE sn='$getstrong'
  $limitstrong=" AND snid='$gstrong'";
  if(($gstrong == 'All')or empty($gstrong) or ($uid==0)){unset($limitstrong);}
  $result6=mysql_query_s('SELECT * FROM bible_strongnumber WHERE sn='."'$getstrong' $limitstrong");
  $num6=mysql_numrows($result6);
  for($i=0;$i<$num6; ++$i) {
    $ahlb=mysql_result($result6,$i,'ahlb');
    if(!empty($ahlb)){
      $strextra='Modern: <Font face="arial" size="+2">'.mysql_result($result6,$i,'modern').
      '</font><br>Ancient: '.preg_replace('/ah_(\d{2})/i','<img src="img/heb/\1.jpg">',mysql_result($result6,$i,'ancient')).
      '<br><Font face="tempus sans, tempus sans itc">Translit: '.mysql_result($result6,$i,'translit').
      '</font><br>AHLB: '.$ahlb.
      '<br>AH definition: ';
    }
    $strongdefinition=preg_replace('(\r\n)','<br>',mysql_result($result6,$i,'content'));
    #`modern``ancient``translit``ahlb`
    if (!empty($strongdefinition)){echo$strextra.$strongdefinition.N;}
  }echo'<br><a href="/?&b='.$b.'&s='.$getstrong.$scrolll.'">Search for occurreences</a>';
}
elseif(!empty($_GET['ln'])){require('inc/userfeatures_lang_forms.php');}
elseif(!empty($xref)) {	// xrefs (make function?)

$r=mysql_query_s('SELECT * FROM bible_xrefs WHERE verse=\''.$xref.'\' AND mode=1;');
$num11=mysql_numrows($r);
$i=0;while($i<$num11){
  $strongdefinition=preg_replace('(\r\n)','<br>',mysql_result($r,$i,'refs'));
  if (!empty($strongdefinition)){
    $crossreg='/([^\s]\w{1,20}\s\d{1,3}\:(\d{1,4}|\d{1,4}\s{1,5})\-(\d{1,5}|\s{1,5}\d{1,5}))|([^\s|^\-]\w{1,20}\s\d{1,3}\:\d{1,4})|([^\s]\w{1,20}\s[^\w|^\-]\d{1,3}\s)|([^\s]\w{1,20}\s\d{1,3}\s)/i';
    $strongdefinition=preg_replace($crossreg,"<a target='_self' href='/?s=".urlencode("$1").$scrolll."' >$1</a>",$strongdefinition); //old target: middleframe
    echo$strongdefinition.N;
  }
  ++$i;
}
if (!empty($u)) {
  if($mysettings[4]==='1'){$vxs=' or mode=3)';}else{$vxs=')';} //or user=\''.$u.'\' '.$vxs
  $r=mysql_query_s("SELECT * FROM bible_xrefs WHERE verse='$xref' AND (user='$u'".$vxs);
  $num10=mysql_numrows($r);
  if ($num10>=1) {
    $i=0;while($i<$num10){
      $sqlnote=preg_replace('(\r\n)','<br>',mysql_result($r,$i,'refs'));
      $sqlnote=preg_replace('/[^\s]\w{1,20}\s\d{1,3}\:\d{1,4}/i',"<a target='_self' href='".$_SERVER['PHP_SELF']."/?s=".urlencode("$1").$scrolll."' >Link</a>",$sqlnote); //old target: middleframe
      echo $sqlnote.N;
    ++$i;}
  }
  echo"<form action='index.php' method='get'><input type='hidden' name='note' value='".$xref."'>".
      "<textarea name='setxref' rows='11' style=\"width:100%;height:300px;\">"; // cols='28' cols='100%' ?
  if($num10>=1){
    $i=0;while($i<$num10){
      $sqlnote=mysql_result($r,$i,'refs');
      if(!empty($sqlnote)){echo$sqlnote;}
      ++$i;}
  }
  echo'</textarea>'.N.'<input type="submit" value="Save"></form>';
}
}
elseif(!empty($cross)) { // output crossreference-verse / 123
  echo"<a target='_self' href='$subd/?userfeatures=".urlencode($reref)."&reref=".urlencode($reref)."&b=".$b.$scrolll."'>BACK</a>".N; //old target: middleframe
  $r=mysql_query_s("SELECT context FROM bible_context WHERE book='$book' AND bid='$b' AND chapter='$chap' AND verse='$versenum'");
  $num7=mysql_numrows($r);
    //$sqlchapter=mysql_result($r,$i,"chapter");
    //$svnum=mysql_result($r,$i,"verse");
    //$s_bk=mysql_result($r,$i,"book");
  $i=0;while($i<$num7){
    $sqlcontext=mysql_result($r,$i,'context');
    echo "<a target='_self' href='$subd/?userfeatures=".urlencode($cross)."&b=".$b."&reref=".urlencode($reref).$scrolll."'>$cross</a> ".$sqlcontext.N; //old target: middleframe
    ++$i;}  
}
elseif(!empty($setbookmark) && !empty($u)) { // set/remove bookmark
  // $setbookmark $u
  //"DELETE FROM bible_bookmarks WHERE id='".$setbookmark."'"
  $note_e=explode(' ',$setbookmark);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  
  $r=mysql_query_s('SELECT id FROM bible_bookmarks WHERE (bookmark=\''.$setbookmark.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')');
  $num7=mysql_numrows($r);
  if ($num7>=1) { $r='DELETE FROM bible_bookmarks WHERE ((bookmark=\''.$setbookmark.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.' )'; }
  else { $r ="INSERT INTO bible_bookmarks (id,b,c,v,v2,uid,datetime) VALUES (NULL,'$note_b',$note_c,$note_v,$note_v2,'$uid', NOW())"; }
  $r=mysql_query_s($r);
  echo'Bookmark Edited';
  //echo $mysqldo.N;
  // for($i=0;$i<$num7; ++$i) { }
} // <- set/remove bookmark
elseif(!empty($setxref) && !empty($u)) { // set/update/remove xrefs
  $note_e=explode(' ',$note);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  $result8=mysql_query_s('SELECT * FROM bible_xrefs WHERE (verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.');');
  $num8=mysql_numrows($result8);
  
/*

  $result8=mysql_query_s('SELECT * FROM bible_notes WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.');');
  $num8=mysql_numrows($result8);
  if($uid==0){if(preg_match('/(www\.)|(http\:)|(\.com)|(\.net)|(\.org)/i',$note)){die('access denied');}}
  if ($num8>=1) {
    for($i=0;$i<$num8; ++$i) {
      $sqlnote=mysql_result($result8,$i,'note');
      if (!empty($sqlnote)) { if ($sqlnote == $setnote) { $sqlfoundnote='1'; } }
    }
    if (isset($sqlfoundnote)) { $mysqldo='DELETE FROM bible_notes WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')'; }
    else { $mysqldo='UPDATE bible_notes SET note=\''.$setnote.'\',datetime=NOW() WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')'; }
  }
  else { $mysqldo ="INSERT INTO bible_notes (id,b,c,v,v2,uid,datetime,note) VALUES (NULL,'$note_b',$note_c,$note_v,$note_v2, '$uid', NOW() ,'".htmlentities(preg_replace($tag_filter,'',$setnote),ENT_QUOTES,'UTF-8')."')"; }

*/

  if ($num8>=1) {
    for($i=0;$i<$num8; ++$i) {
      $sqlnote=mysql_result($result8,$i,'refs');
      if(!empty($sqlnote)){if($sqlnote == $setxref){$sqlfoundnote='1';}}
    }
  if (isset($sqlfoundnote)){$mysqldo='DELETE FROM bible_xrefs where ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')'; echo 'xRef removed';}
  else{$mysqldo='UPDATE bible_xrefs SET refs=\''.$setxref.'\',datetime=\'NOW()\' WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')'; echo 'xRef updated';}
  }//id 	verse 	group 	mode 	user 	datetime 	refs 
  else {if($mysettings[4]==='1'){$vxs='3';}else{$vxs='2';}
  if(!isset($tag_filter)){require('inc/tag_filter.php');}
  $mysqldo ="INSERT INTO bible_xrefs (id,b,c,v,v2,`group`,mode,uid,datetime,refs) VALUES (NULL, '$note_b',$note_c,$note_v,$note_v2,NULL,'$vxs', '$uid', NOW() ,'".htmlentities(preg_replace($tag_filter,'',$setxref),ENT_QUOTES,'UTF-8')."')"; }
  if (!empty($mysqldo)) {if($uid==0){if(preg_match('/(www\.)|(http\:)|(\.com)|(\.net)|(\.org)/i',$note.$setxref)){die('access denied');}} $result8=mysql_query_s($mysqldo); echo N.'xRef Edited'; }
} // <- set/update/remove xrefs
elseif(!empty($setnote2) && !empty($u)) {	//view note
  echo "<form action='index.php' method='get'><input type='hidden' name='note' value='$userfeatures'>
	<textarea name='setnote' rows='11' style=\"width:100%;height:300px;\" >"; // cols='100%' ?
	$note_e=explode(' ',$userfeatures);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  $r=mysql_query_s('SELECT * FROM bible_notes WHERE ((verse=\''.$userfeatures.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.' );');
  $num10=mysql_numrows($r);
  if($num10>=1){
    for($i=0;$i<$num10; ++$i) {
      $sqlnote=mysql_result($r,$i,'note');
      if (!empty($sqlnote)) { echo $sqlnote; }
    }
  }
  echo'</textarea><br><input type="submit" value="Save"></form>';
  if($mysettings[5]==='1'){ //display other sources
    $r=mysql_query_s("SELECT * FROM bible_notes WHERE verse='$userfeatures' AND (user!='$u' AND mode=3)");
    $num10=mysql_numrows($r);
    if($num10>=1){
      for($i=0;$i<$num10; ++$i) {
	$sqlnote=mysql_result($r,$i,'note');
	if (!empty($sqlnote)) { echo $sqlnote.N; }
      }
    }
  }
  
} //<- view note
elseif(!empty($setnote)) { // set/update/remove note
  if(!isset($tag_filter)){require('inc/tag_filter.php');}
  $note_e=explode(' ',$note);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  $result8=mysql_query_s('SELECT * FROM bible_notes WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.');');
  $num8=mysql_numrows($result8);
  if($uid==0){if(preg_match('/(www\.)|(http\:)|(\.com)|(\.net)|(\.org)/i',$note)){die('access denied');}}
  if ($num8>=1) {
    for($i=0;$i<$num8; ++$i) {
      $sqlnote=mysql_result($result8,$i,'note');
      if (!empty($sqlnote)) { if ($sqlnote == $setnote) { $sqlfoundnote='1'; } }
    }
    if (isset($sqlfoundnote)) { $mysqldo='DELETE FROM bible_notes WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')'; }
    else { $mysqldo='UPDATE bible_notes SET note=\''.$setnote.'\',datetime=NOW() WHERE ((verse=\''.$note.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.')'; }
  }
  else { $mysqldo ="INSERT INTO bible_notes (id,b,c,v,v2,uid,datetime,note) VALUES (NULL,'$note_b',$note_c,$note_v,$note_v2, '$uid', NOW() ,'".htmlentities(preg_replace($tag_filter,'',$setnote),ENT_QUOTES,'UTF-8')."')"; }
  if (!empty($mysqldo)) { $result8=mysql_query_s($mysqldo); echo N.'Note Edited'; }
  if($uid==1){echo$mysqldo;}
} // <- set/update/remove note
elseif(!empty($setfavorite) && !empty($u)) { // set/remove favorite\s
  $note_e=explode(' ',$setfavorite);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  $r=mysql_query_s('SELECT id FROM bible_favorites WHERE ((favoriteverse=\''.$setfavorite.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.' )');
  $num9=mysql_numrows($r);#bible_favorites bible_bookmarks
  if ($num9>=1) { $r='DELETE FROM bible_favorites WHERE ((favoriteverse=\''.$setfavorite.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.' )'; }
  else { $r ="INSERT INTO bible_favorites (id,b,c,v,v2,uid,datetime) VALUES (NULL,'$note_b',$note_c,$note_v,$note_v2, '$uid', NOW())"; }
  mysql_query_s($r);
  if($uid==1){echo$r.'hey';}
  echo'Favorite Edited';
} // <- set/remove favorite\s
elseif(isset($_GET['toto1']) && !empty($u)) {
 if(!empty($_GET['toto1'])){
  $stitle=addslashes($_GET['toto1']);
  $sbook=substr($stitle,0,1);
  $scontext=addslashes($_GET['tosub']);
  $sverse=addslashes($_GET['toto']);
  $ssubcontext=addslashes($_GET['topict']);
  $mysqldo_check = 'SELECT pid FROM bible_super_dial_context WHERE uid='.$uid.' AND title=\''.addslashes($title).'\' AND mid='.$mid.' AND type=\''.addslashes($title).'\';';
  $mysqldo_update = $mysqldo_check; //quickfix
  $note_e=explode(' ',$sverse);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  $date=time();//preg_replace('/([^\\])\'/i','\1\\\'',
  $dtid=mysql_result(mysql_query_s('SELECT tid FROM bible_topic_list WHERE title=\''.addslashes($_GET['toto']).'\';'),0,'tid');
  $mid=mysql_result(mysql_query_s('SELECT mid FROM bible_super_dial WHERE title=\'u'.$uid.'\';'),0,'mid');
  if(empty($mid)){
    mysql_query_s("INSERT INTO bible_super_dial (title, levels, `global`, shared,readwrite,midc,uid)
                 VALUES ('u$uid', '','','','','',$uid);");
    $mid=mysql_result(mysql_query_s('SELECT mid FROM bible_super_dial WHERE title=\'u'.$uid.'\';'),0,'mid');
  }
  /*
#type|trioarg|Book|title|context|verses|date||||subcontext|Linked[See also]|Linked[Also Called]|topicid
5||A|A||||||See <dfn>ALPHA</dfn>|||
5||A|AARON||||||(<i>a teacher, or lofty</i>),
  */
  if(empty($_GET['toto'])){$ttype=1;}
  else{$ttype=1;}
  
  $mysqldo = 'INSERT INTO bible_super_dial_context (pid,mid,uid,book,type,date,trioarg,title,context,verses,firstyear,lastyear,subcontext,l,l2,tid)
  VALUES (NULL,'.$mid.','.$uid.',\''.$sbook.'\',\''.$ttype.'\','.$date.',\'\',\''.$stitle.'\',\''.$scontext.'\',\''.$sverse.'\',\'\',\'\',\''.
  $ssubcontext.'\',\'\',\'\',\''.$dtid.'\')';
  #if($uid=1){echo$mysqldo;}
  mysql_query_s($mysqldo);
  $mysqldo_update = $mysqldo; //bad fix
  
  $checkq='SELECT pid FROM bible_topic_link WHERE uid='.$suid.' and book=\''.$sbook.'\' and type=\''.$stype.'\' and
		    title=\''.$stitle.'\' and context=\''.$scontext.'\' and subcontext=\''.$ssubcontext.'\' and b=\''.$note_b.'\' and
		    c='.$note_c.' and v='.$note_v.' and v2='.$note_v2.';';
    #if($uid==1){echo$checkq.N;}
    $sqlcheck=mysql_result(mysql_query_s($checkq),0,'pid');
    #echo $sqlcheck.' '.$checksql.'<br>';
    $themode=$mysettings[23];if(empty($themode)){$themode=1;}
  if(empty($sqlcheck)){mysql_query_s('insert into '.$database.'.bible_topic_link (tid,mid,uid,book,type,title,mode,b,c,v,v2,context,subcontext) values
		  '."('',$smidt,$suid,'$sbook',$stype,'$stitle','$themode','$note_b',$note_c,$note_v,$note_v2,'$scontext','$ssubcontext');");}
 }
}
elseif(isset($_GET['settopic']) && !empty($u)) {
$userfeatures=stripslashes($_GET['settopic']);
echo"<form action='index.php' method='get'><input type='hidden' name='toto' value='$userfeatures'>
Topic<input type='text' name='toto1' id='toto1'><br>Sub Topic<input type='text' name='tosub' id='tosub'>(optional)<br>Description(optional)
	<textarea name='topict' rows='11' style=\"width:100%;height:300px;\" >"; // cols='100%' ?
	$note_e=explode(' ',$userfeatures);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
  if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
  else{$note_v2='NULL';}
  $r=mysql_query_s('SELECT * FROM bible_notes WHERE ((verse=\''.$userfeatures.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.' );');
  $num10=mysql_numrows($r);
  if($num10>=1){
    for($i=0;$i<$num10; ++$i) {
      $sqlnote=mysql_result($r,$i,'note');
      if (!empty($sqlnote)) { echo $sqlnote; }
    }
  }
  
  echo'</textarea><br><input type="submit" value="Save"></form>
  <script type="text/javascript" src="inc/ajax/hit/js/bsn.Ajax.js"></script>
  <script type="text/javascript" src="inc/ajax/hit/js/bsn.AutoSuggest.js"></script>
  <script type="text/javascript" src="inc/ajax/hit/js/bsn.DOM.js"></script>';
if(isset($_GET['b'])){$hbi='bible:'.$bsel.',';}
if(!isset($dosho)){$dosho='s';}

if(isset($_GET['b'])){$hbi='bible:'.$b.',';}
if(!empty($_GET['m'])){$hcm='cmode:"'.$_GET['m'].'",';}
if(isset($_GET['tri'])){$htm='tri:1,';}
//elseif(isset($fp)){$hcm='cmode:1,';}
//if(isset($_GET['m'])){$sm='mode:'.$_GET['m'].',';}
echo'
<script type="text/javascript">var options = {script:"inc/ajax/hit/topic.php?",varname:"input",minchars:1,'.$hbi.$hcm.$htm.'};
var as = new AutoSuggest(\'toto1\', options);var as2 = new AutoSuggest(\'tosub\', options);
</script>
</body></html>';#var as2 = new AutoSuggest(\'tosub\', options);


}
elseif(!empty($userfeatures) && !empty($u)) { // User Feature Page //looks a bit clumsy, make cleaner?
  if ($mode_fview_main == 'noteview') {$notefirst='1';}
  $r=mysql_query_s('SELECT * FROM bible_xrefs WHERE verse=\''.$userfeatures.'\' AND mode=1');$num11=mysql_numrows($r);
  if (empty($num11)) { $r=mysql_query_s("SELECT * FROM bible_xrefs WHERE verse='$userfeatures' AND mode=1");$num11=mysql_numrows($r); }
  if (empty($num11)) {$notefirst='1';}  // remove this if you want xrefs first when no xrefs present.
  $fli_basis='<a href="'.$subd.'/?'; // old target: middleframe

  $fli_basis2=preg_replace('/\s/','+',$userfeatures);
  $fli="&#177$fli_basis"."setbookmark=$fli_basis2$scrolll\">Bookmark</a> ";
  $fli2="&#177$fli_basis"."setfavorite=$fli_basis2$scrolll\">Favorite</a> ";
  $fli7="+$fli_basis"."settopic=$fli_basis2$scrolll\">Topic</a> ";
  if (isset($notefirst)) {
    $fli4="&#177$fli_basis"."xref=$fli_basis2$scrolll\">xRefs</a> ";
    $fli3="-$fli_basis"."setnote=$fli_basis2$scrolll'>Note</a> ";
  }
  else {$fli3='&#177'.$fli_basis.'setnote2='.$fli_basis2.$scrolll.'">Note</a> ';}
  if (!empty($reref)) { $fli5=$fli_basis."userfeatures=".urlencode($reref)."&b=".$b."&reref=".urlencode($reref).$scrolll."\">BACK</a> "; }
  $fli6='<a href="'.$subd.'/?s='.urlencode($userfeatures).'&b='.$b.$scrolll.'">'.$userfeatures.'</a> ';;
  echo $fli5.$fli4.' '.$fli.' '.$fli2.' '.$fli3.' '.$fli7.' '.$fli6.N.
   '<form action="index.php" method="get"><input type="hidden" name="note" value="'.$userfeatures.'"><input type="hidden" name="reref" value="'.urlencode($reref).'">';
if (isset($notefirst)) {
  echo'<textarea name="setnote" rows="11" style=\"width:100%;height:300px;\" >'; //cols='100%'?
  $r=mysql_query_s('SELECT * FROM bible_notes WHERE verse=\''.$userfeatures.'\' AND user=\''.$u.'\'');
  $num10=mysql_numrows($r);
  if($num10>=1) {
    for($i=0;$i<$num10; ++$i) {
      $sqlnote=mysql_result($r,$i,'note');
      if(!empty($sqlnote)){echo$sqlnote;}
    }
  }
}
else {
  function crossreflinker($crossreflinker) {
    $cross=preg_match_all('/([^\s]\w{1,20}\s\d{1,3}\:(\d{1,4}|\d{1,4}\s{1,5})\-(\d{1,5}|\s{1,5}\d{1,5}))|([^\s\-]\w{1,20}\s\d{1,3}\:\d{1,4})|([^\s]\w{1,20}\s[^\w\-]\d{1,3}\s)|([^\s]\w{1,20}\s\d{1,3}\s)/i',$crossreflinker,$crossrefs,PREG_OFFSET_CAPTURE);
    $crossall='<a href="'.$GLOBALS['subd'].'/?b='.$GLOBALS['bible'].'&s='; //http://'.$_SERVER['HTTP_HOST'].'
    foreach($crossrefs[0] as $crossref) {
      $urlref=urlencode($crossref[0]);
      $crossall .= urlencode($checking.'.'.$crossref[0]);
      $checking=' ';
      $htmlref='<a href="'.$GLOBALS['subd'].'/?b='.$GLOBALS['bible'].'&s='.$urlref.'&reref='.urlencode($GLOBALS['userfeatures']).$scrolll.'">'.$crossref[0].'</a> ';
      $crossreflinker=str_replace($crossref[0],$htmlref,$crossreflinker);
    }
    $crossall .= '&reref='.urlencode($GLOBALS['userfeatures']).$scrolll.'">List All xRefs</a>'.N;
    return $crossall.$crossreflinker;
  }
  for($i=0;$i<$num11; ++$i) { // sql a few lines above
    //$strongdefinition=preg_replace("/[^\s]\w{1,20}\s\d{1,3}\:\d{1,4}/i","<a target='middleframe' href='".$_SERVER['PHP_SELF']."/?s=".urlencode(".$1.")."' >$1</a>",$strongdefinition);
    $strongdefinition=preg_replace('(\r\n)','<br>',mysql_result($r,$i,'refs'));
    echo'<p>'.crossreflinker($strongdefinition).'</p>';
  }
  if (!empty($u)) {
    $note_e=explode(' ',$userfeatures);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
    if(strstr($note_v,'-')){$note_e=explode('-',$note_e);$note_v=$note_e[0];$note_v2=$note_e[1];}
    else{$note_v2='NULL';}

    $r=mysql_query_s('SELECT * FROM bible_xrefs WHERE ((verse=\''.$userfeatures.'\')or(b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.')) AND (user=\''.$u.'\' or uid='.$uid.');');
    $num10=mysql_numrows($r);
    if ($num10>=1) {
      for($i=0;$i<$num10; ++$i) {
	$sqlnote=mysql_result($r,$i,'refs');
	$sqlnote=preg_replace('(\r\n)',' <br> ',$sqlnote);
	if (!empty($sqlnote)) { echo N.crossreflinker($sqlnote).N; }
      }
    }
    echo'<textarea name="setxref" rows="11" style=\"width:100%;height:300px;\" >'; //cols='100%' ?
    if ($num10>=1) {
      for($i=0;$i<$num10; ++$i) {
	$sqlnote=mysql_result($r,$i,'refs');
	if (!empty($sqlnote)) { echo $sqlnote; }
      }
    }
  }
}
echo'</textarea>'.N.'<input type="submit" value="Save"></form>';
$note_e=explode(' ',$userfeatures);$note_b=strtoupper($note_e[0]);$note_e=explode(':',$note_e[1]);$note_c=$note_e[0];$note_v=$note_e[1];
$thesql='select * from bible_topic_link where b=\''.$note_b.'\' and c='.$note_c.' and v='.$note_v.' and mid=7'; #and uid='.$uid
echo NN;
$sql=mysql_query_s($thesql);
  $numnote="";$numnote=mysql_numrows($sql);
  if($numnote>0){
  $dotoec=1;$i=0;
  if($numnote>=1){echo'<u>Results in topic maps</u>'.N;}
  while($i<=$numnote){    
    $sbook3=mysql_result($sql,$i,'title');$smidt=mysql_result($sql,$i,'mid');$suid=mysql_result($sql,$i,'uid');
    $stype=mysql_result($sql,$i,'type');$sverses=mysql_result($sql,$i,'verses');
    $sbook=mysql_result($sql,$i,'book');$ssubcontext=mysql_result($sql,$i,'subcontext');
    if($smidt!==$smidtt){
      echo N.'<b>'.mysql_result(mysql_query_s('select title from bible_super_dial where mid='.$smidt),0,'title').'</b>'.N;
      $smidtt=$smidt;
    }
    $scontext=mysql_result($sql,$i,'context');
    if(!empty($ssubcontext)){$thesub=' ('.$ssubcontext.')';}
    if(!empty($scontext)){$thecon=' - '.$scontext;}
    if(!empty($sbook3)){echo' <a href="/?topic'.$bl.'&bk='.$sbook.'&dial='.$smidt.'#'.$sbook3.'">'.$sbook3.$thecon.$thesub.'</a>'.N;
      if(isset($thesub)){unset($thesub);}
    }
    ++$i;
  }
}
/*
mysql_query_s('insert into bible_topic_link (tid,mid,uid,book,type,title,mode,b,c,v,v2) values
		  '."('',$smidt,$suid,'$sbook',$stype,'$sbook3',1,'$sb',$sc,$sv,$sv2);");
*/
echo$footer;
}
# licence: gpl-signature.txt?>