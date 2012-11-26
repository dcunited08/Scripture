<?php
$docols=40;
if(!isset($no_mobile)){$docols=30;}
echo'<form name="news">
<textarea name="news2" cols='.$docols.' rows=10 wrap=virtual></textarea>
</form>

<script language=JavaScript>

var newsText = new Array();';#$typereader=1;
if(empty($fp)){$s=mysql_query_s($bse) or die(mysql_error());}else{$s="";}$num5=mysql_numrows($s);
$i7=0;
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
    $sc=preg_replace('/(\r)|(\n)/',"",mysql_result($s,$i,'context'));
    
    if(strstr($sc,'&')){$sc=html_entity_decode(html_entity_decode($sc,ENT_QUOTES));}
    $sc=strip_tags($sc);$sc=str_replace('  ',' ',$sc);$sc=str_replace('  ',' ',$sc);
    echo'newsText['.$i7.']="'.$l.' '.str_replace('"',"'",$sc).'";'."\r\n";++$i7;
    ++$i;
}
if(isset($_GET['tspeed'])){$tspeed=stripslashes($_GET['tspeed']);}else{$tspeed=79;}
if(isset($_GET['sspeed'])){$sspeed=stripslashes($_GET['sspeed']);}else{$sspeed=3300;}
echo'
var ttloop = 1;    // Repeat forever? (1 = True; 0 = False)
var tspeed = '.$tspeed.';   // Typing speed in milliseconds (larger number = slower)
var tdelay = '.$sspeed.'; // Time delay between newsTexts in milliseconds

// ------------- NO EDITING AFTER THIS LINE ------------- \\
var dwAText, cnews=0, eline=0, cchar=0, mxText;

function doNews() {
  mxText = newsText.length - 1;
  dwAText = newsText[cnews];
  setTimeout("addChar()",1000)
}
function addNews() {
  cnews += 1;
  if (cnews <= mxText) {
    dwAText = newsText[cnews];
    if (dwAText.length != 0) {
      document.news.news2.value = "";
      eline = 0;
      setTimeout("addChar()",tspeed)
    }
  }
}
function addChar() {
  if (eline!=1) {
    if (cchar != dwAText.length) {
      nmttxt = ""; for (var k=0; k<=cchar;k++) nmttxt += dwAText.charAt(k);
      document.news.news2.value = nmttxt;
      cchar += 1;
      if (cchar != dwAText.length) document.news.news2.value += "_";
    } else {
      cchar = 0;
      eline = 1;
    }
    if (mxText==cnews && eline!=0 && ttloop!=0) {
      cnews = 0; setTimeout("addNews()",tdelay);
    } else setTimeout("addChar()",tspeed);
  } else {
    setTimeout("addNews()",tdelay)
  }
}

doNews()
</script>';
require('inc/parsemapaudio.php');
?>