<?php # licence: gpl-signature.txt
$memory_start=memory_get_usage();
if(empty($_GET['pos']) && (!empty($_GET['s']) or !empty($_POST['lookup'])or isset($_GET['bdial']) or !empty($_GET['bookmark']) or !empty($_GET['note']) or !empty($_GET['favorite']))){require('inc/redirect.php');}
if(!@require('init.php')){
  if(file_exists('http://scripture.cvs.sourceforge.net/viewvc/scripture/scripture/updater.php?content-type=text%2Fplain&pathrev=HEAD')){
      // function used when there is updates core-ly
      $username='databaseusername'; $password='databasepassword'; $database='database'; $database_host='127.0.0.1'; $website_email="scripture@google.com"; $mailer_name = "BibleWay.us"; $firsttime = '1'; $smtp_host='smtphost';$smtp_username='smtpuser';$smtp_pass='smtppass';
      $majorupdatelink='http://scripture.cvs.sourceforge.net/viewvc/scripture/scripture/updater.php?content-type=text%2Fplain&pathrev=HEAD';
      $majorupdate=file_get_contents($majorupdatelink);$updatetofile=fopen('updater.php', 'a') or die('can\'t open file');
      fwrite($updatetofile,$majorupdate);fclose($updatetofile);$firsttime='1';
  }require('updater.php');
}elseif(!empty($firsttime)){require('starter.php');}
else{
if($uid==='1'){$time=explode(' ',microtime());$start_pf=$time[1] + $time[0];}
require('parsefilter.php');
if($uid==='1'){$time=explode(' ',microtime());$end_pf=$time[1] + $time[0];echo$doexpro;}
// HTML Bible List
if(empty($getstrong) && empty($setbookmark) && empty($userfeatures) && empty($setfavorite) && !isset($_GET['settopic']) && !isset($_GET['topict']) && empty($setxref) && empty($cross) && empty($setnote2) && empty($setnote) && empty($_GET['xref'])){//check if features used
$largelist=1;if(isset($largelist)or(isset($_GET['largelist']))){
  $r=mysql_query_s('SELECT * FROM bible_list order by lang,bname ASC');
  require('inc/Language_codes.php');}
else{$r=mysql_query_s('SELECT * FROM bible_list order by bid ASC');}
$num=mysql_numrows($r);//[†]
if($l=='n'){require('inc/Languages/Menu_Norwegian.php');}
else{require('inc/Languages/Menu_English.php');}

if(!isset($fp)){$menu='<div id="menu">';$menu2='<a class="tme" href="'."$subd/?fp$bl&bk=$book$scrolll".'">'.$l_m1.'</a>';}
else{echo'<div id="menu">';}
if(!isset($_GET['new'])and!isset($_GET['createcontent'])and!isset($_GET['edit'])){$doejs='textarea';$textarea='<textarea rows="5" id="s" name="s" tabindex=1>';}
else{$doejs='input';$textarea='<input type="text" name="s" id="s" tabindex=1>';}
//if(isset($fp)){$fpwidth=' width="100%"';}
if(isset($no_mobile)){$dospace3='</td><td>'.N;$dospace2=N;}
else{$dospace4='</td><tr></tr><td>';}
echo$menu.'<table'.$fpwidth.'><tr><td>'.$menu2.'<form action="index.php" method="get">'.$textarea.$mode_enabled.$nohighlight.$se.'</textarea>'.$dospace4.
'<select name="b[]" MULTIPLE size=6 tabindex=2>';//SIZE=3
/*if(!empty($tools)or isset($ismultib)){echo'<select name="b[]" MULTIPLE SIZE=3>';}
else{echo'<select name="b" style="width:104">';}*/
$bidarray=array();$totranslate=array();$bfonts=array();
$i=0;while($i<$num){
 $bid=mysql_result($r,$i,'bid');$bsn=mysql_result($r,$i,'bsn');$bname=mysql_result($r,$i,'bname');$bfont=mysql_result($r,$i,'font');
 $lang=mysql_result($r,$i,'lang');$suids=mysql_result($r,$i,'uids');$sglobal=mysql_result($r,$i,'global');$sowner=mysql_result($r,$i,'owner');
 $lang=preg_replace('/(\s)|(\n)|(\r)/i','',$lang);
 if(!empty($bfont)){$bfonts[$bid]=$bfont;}
 if(preg_match('/(,|^)'.$bid.'(,|$)/',$mysettings[22])){$nobshow=1;}
  if(isset($largelist)and!isset($nobshow)){
   if($lang!=$tmplang){
    $rml=mysql_query_s('SELECT bid FROM bible_list WHERE lang='."'$lang' order by bid;");
    $nml=mysql_numrows($rml);$mlb="";
    $iml=0;while($iml<$nml){
      $mlbi=mysql_result($rml,$iml,'bid');
      if($iml==0){$mlb=$mlbi;}
      else{$mlb.=','.$mlbi;}
      ++$iml;
    }
    if(!empty($a_lcodes[$lang])){$token_lang=$a_lcodes[$lang];}
    else{$token_lang=$lang;}
    echo"<option value='$mlb'> -".$token_lang."</option>";
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
    if(!empty($ismultib)&&in_array($bid,$ismultib)){$bsel=$bid;$ssbible2=' selected';}
    elseif($b===$bid){$ssbible2= ' selected';$a_b='';$bsel=$bid;}else{unset($ssbible2);}
    echo "<option value='$bid' name='$bsn'$ssbible2>".$bname.'['.$bid.']</option>'; // bsn $bsn lang $lang 
  } elseif($b===$bid){die('Access denied or no scripture found.');} //scripture-security
  if($b==='all'){$ssbible2=' selected';}else{$ssbible2="";}
  }else{unset($nobshow);}
  ++$i;
}
echo'<option value="all"'.$ssbible2.'>'.$l_m2.'</option></select>'.$dospace3;
if(!isset($no_mobile)){echo'</td><tr></tr><td>';}
echo'<input type="checkbox" name="all" value="1">Show All<br>
<input type="checkbox" name="scroll"'.$scrollcheck.'>Scroll<br>
<select name="bk" style="width:54">';//49firefox
//$rbk=mysql_query_s('SELECT DISTINCT book FROM bible_context WHERE bid=\''.$b.'\' ORDER BY vsid ASC');//HTML Book-list-Selector
if(strstr($b,',')){$bks=' IN(';$bks2=')';}else{$bks='=';}
if($l=='ru'){$bla=52;}
elseif($l=='n'){$bla=6;}
else{$bla=$b;}
$rbk=mysql_query_s('SELECT DISTINCT book,sname FROM bible_book_name WHERE bid'."$bks$bla$bks2");
//if($uid==1){echo'<option value="'.$a_shortdrupal[1].'"></option>';}
$numrbk=mysql_numrows($rbk);
$i=0;while($i<$numrbk){
  $sqbook=mysql_result($rbk,$i,'sname');
  if(!empty($sqbook)){
   $bk2=mysql_result($rbk,$i,'book');
   if(empty($b_name3)and(strtolower($sqbook)===strtolower($book))){$b_num3=$i;$b_name3=$sqbook;$ssbible2=' selected';}elseif(isset($ssbible2)){$ssbible2="";}
   //$b_name2=$sqbook; olduse before </option>
   echo"<option value='$sqbook'$ssbible2>".mysql_result($rbk,$i,'book')."</option>";
  }++$i;
}echo'</select>'.$dospace2.'<select name="cs" style="width:40">';//37firefox // HTML chap list selector
$r=mysql_query_s('SELECT chap FROM bible_book_name WHERE bid'."$bks$b$bks2".' and sname like \''.strtoupper($b_name3).'\';');
$sqnum=mysql_result($r,0,'chap');unset($ssbible2);
if(empty($chap)){$chap=1;}
$i=1;while($i<=$sqnum){
  if($i==$chap){$ssbible2=' selected';}elseif(isset($ssbible2)){$ssbible2="";}
  echo"<option value='$i' $ssbible2>$i</option>";
  ++$i;
}echo'</select><input type="submit" value="'.$l_m3.'" class="go" tabindex=3>';
/*$tlink='Tools';$toolshtml='&tools=1';
if(!empty($tools)){require('tools.php');$tlink="Back";$toolshtml="";}
elseif(!empty($_GET['mypage'])){echo' <a href="?mydata=1'.$bl.'">myData</a> <a href="?mydata=settings'.$bl.'">Settings</a>  ';}
elseif(isset($forum) or !empty($groups)){$tlink='Back';$toolshtml='&tools=1';}
echo' <a href="?s='.urlencode($regex_enabled.$se).$bl.'&bk='.$book.'&c='.$chap.$toolshtml.'">'.$tlink.'</a> ';
if(!empty($tools)){echo'<a href="?s='.urlencode($regex_enabled.$se).$bl.'&bk='.$book.'&c='.$chap.'&forum">Forum</a> ';}
if(isset($forum)){echo'<a href="?groups=1'.$bl.'">Groups</a> ';}*/
if(!isset($fp)){echo'<input name="ch" type="submit" value="&#60;&#60;"><input name="ch" type="submit" value="&#62;&#62;">';}
echo'<input type="hidden" name="c" value="'.$chap.'">'.$dofb;
//if(($mysettings[11]!=='2')and isset($fp)){echo'</td><td>';}//require('inc/Menu.php');}
if(($u==='demo')){if(isset($no_mobile)){$new2='<br>';}$new3='  <a href="users.php">'.$l_m17.'</a>';}
if(isset($fp)){
    if($uid==0){$sc_info='</td>';}
if(!isset($no_mobile)){$trmob='</tr><tr>';}
elseif($uid==0){echo'<td colspan="2">'.$sc_info;}
$logo='<img src="img/icon_gold.png">'.$new2.'</td>'.$trmob.'<td><b>'.$mailer_name.'</b>';
if(!empty($l_m18)){echo'<br><sup>'.$l_m18.'</sup>';}
if(isset($no_mobile)){echo'</td><td align="right">'.$logo.'</td>';}
    echo'</tr><tr>';
    echo'<td colspan="4"><a href="'.$subd.'?searcher&b='.$b.'">'.$l_m13.'</a>  <a href="dialer.php?b='.$b.'">Dialer</a>   
    <a href="'.$subd.'?shoot&b='.$b.'">Shooter</a>  ';
    if(!isset($no_mobile)){echo'</td></tr><tr><td>';}
    if($uid!=='0'){$l_m12=$l_m23;}
    echo'<a href="'.$subd.'?forum'.$bl.$bookli.'">'.$l_m14.'</a>  <a href="'.$subd.'?mydata=settings'.$bl.$bookli.'">'.$l_m11.'</a>'.$new3.' <a href="/users.php">'.$l_m12.'</a>';
    if(!isset($no_mobile)){echo'</td></tr><tr><td>'.$logo.'</tr>';if($uid==0){echo'<tr><td>'.$sc_info.'<br></tr>';}}
//$do_donate='1';
}
echo'</td></tr></table></form>';
if(isset($fp)){
  echo'<hr>The Lords Way <sup>Follow it, or find eternal damnation</sup><br>
  <a href="/?s=ROM+2:13&b=1">ROM 2:13</a> (For not the hearers of the law [are] just before God, but the doers of the law shall be justified.)<p></p>
  <a href="/?s=COL+3:1-4&b=1">COL 3:1-4</a> 1 [THE TRUE CENTER OF CHRISTIAN LIFE] If ye then be risen with Christ, seek those things which are above, where Christ sitteth on the right hand of God. 2 Set your affection on things above, not on things on the earth. 3 For ye are dead, and your life is hid with Christ in God. 4 When Christ, [who is] our life, shall appear, then shall ye also appear with him in glory.<br>
  <a href="/?s=1CO+3&b=1">1CO 3:1</a> And I, brethren, could not speak unto you as unto spiritual, but as unto carnal, [even] as unto babes in Christ.<br>
2 I have fed you with milk, and not with meat: for hitherto ye were not able [to bear it], neither yet now are ye able.<br>
3 For ye are yet carnal: for whereas [there is] among you envying, and strife, and divisions, are ye not carnal, and walk as men?<br>
4 For while one saith, I am of Paul; and another, I [am] of Apollos; are ye not carnal?<br>
5 Who then is Paul, and who [is] Apollos, but ministers by whom ye believed, even as the Lord gave to every man?<br>
6 I have planted, Apollos watered; but God gave the increase.<br>
7 So then neither is he that planteth any thing, neither he that watereth; but God that giveth the increase.<br>
8 Now he that planteth and he that watereth are one: and every man shall receive his own reward according to his own labour.<br>
9 For we are labourers together with God: ye are God\'s husbandry, [ye are] God\'s building.<br>
10 According to the grace of God which is given unto me, as a wise masterbuilder, I have laid the foundation, and another buildeth thereon. But let every man take heed how he buildeth thereupon.<br>
11 For other foundation can no man lay than that is laid, which is Jesus Christ.';
}
echo'</div>'; // FONT SIZE //  <hr size="4" //<body  bgcolor="'.$fontbackground.'"><font size="'.$fontsize.'" color="'.$fontcolor.'" face="'.$fontface.'">
if(!isset($nodiv)){echo'<div id="content">';
if(($uid==1)and isset($ksjdfkjdsf)){$scontext="kjd'fgk'j";echo htmlentities(mysql_query_s2('insert into bible_topic_link (tid,mid,uid,book,type,title,mode,b,c,v,v2,context,subcontext) values
		  '."('',$smidt,$suid,'$sbook',$stype,'$sbook3',1,'$sb',$sc,$sv,$sv2,'$scontext','$ssubcontext');"));}}
if($uid==='1'){$time=explode(' ',microtime());$end_in=$time[1] + $time[0];}
if(!isset($a_b)&&isset($bsecountall)){require('inc/searchall.php');}
if(isset($bsecount)){require('inc/searchnums.php');}
if(((empty($seonly)or isset($_GET['all']))and empty($tools)and!isset($forum)and empty($groups)and empty($_GET['lookups'])and
    empty($mydata)and empty($_GET['mypage'])and($simplified_mode!=='r')and!isset($_GET['geo'])and!isset($_GET['tv'])and
    !isset($_GET['rl'])and!isset($_GET['alv'])and!isset($_GET['searcher'])and!isset($_GET['shoot'])and!isset($_GET['para'])and
    !isset($_GET['topic'])and!isset($_GET['tl'])and!isset($_GET['tlg'])and!isset($_GET['edf'])and!isset($_GET['mind']))
 or(!empty($sebookmatched)and($simplified_mode!=='r'))){
  if(isset($scrollstart)){echo$scrollstart.NN;}
 require('inc/parser.php');
  if(isset($scrollstart)){
    echo'<form action="index.php" method="get">'.$scrollstop.'
    <input type="hidden" name="bk" value="'.$book.'">
    <input type="hidden" name="c" value="'.$chap.'">
    <input type="hidden" name="scroll">
    <input type="text" name="sspeed" value="'.$sspeed.'">
    <input type="submit" value="Change Speed">[ms]
    </form>';
    }
 }
elseif(isset($_GET['searcher'])or($simplified_mode=='r')){require('advanced_search.php');}
elseif(isset($_GET['shoot'])){require('inc/ajax/hit/index.php');$dosho='s2';}
elseif(isset($_GET['para'])){require('inc/paraphrase.php');}
elseif(isset($forum)){require('forum.php');}
elseif(isset($_GET['tv'])or isset($_GET['rl'])){require('inc/tv.php');}
elseif(!empty($groups)){require('groups.php');}
elseif(!empty($_GET['lookups'])){require('lookups.php');}
elseif(!empty($mydata)){require('mydata.php');}
elseif(!empty($_GET['mypage'])){require('mypage.php');}
elseif(isset($_GET['geo'])){$dirextra='geodata/';include('geodata/geo.php');}
elseif(isset($_GET['alv'])){require('inc/lastvisitorslist.php');}
elseif(isset($_GET['topic'])){require('superdial.php');}
elseif(isset($_GET['tl'])){require('inc/topiclinker.php');}
elseif(isset($_GET['tlg'])){require('inc/topic_list_generator.php');}
elseif(isset($_GET['edf'])){require('inc/admin_edit.php');}
elseif(isset($_GET['mind'])){require('inc/mindmap.php');}
} // check if getstrong, setbookmark
else{require('userfeatures.php');}
if(!empty($_GET['listdelete'])or !empty($_GET['listgo'])){require('mypage.php');}
unset($username,$password,$database,$database_host,$sc);
if(isset($fp)and!empty($donate)){echo'<hr width="100%">';require('inc/donate.php');}
if(($uid==='1')and(!isset($_GET['shoot']))){echo'<hr width="100%">';require('inc/benchmark.php');}
if(isset($fp)and!empty($donate)){echo'</form>';}
}
if(isset($dopic)){echo'<b>If you see this; please contact the administrator and give the following information</b>:'.$mobl.N.'<u>Thank you.</u>';}
#if((isset($fp)or isset($_GET['autocompletetest'])or isset($_GET['searcher']))and isset($no_mobile)and($uid!=='0')){echo
#'<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
#<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js"></script>
#<script src="inc/js/ac2.js"></script>';}
if(isset($doejs)){
if(isset($_GET['b'])){$hbi='bible:'.$bsel.',';}
if(!isset($dosho)){$dosho='s';}

if(isset($_GET['b'])){$hbi='bible:'.$b.',';}
if(!empty($_GET['m'])){$hcm='cmode:"'.$_GET['m'].'",';}
if(isset($_GET['tri'])){$htm='tri:1,';}
//elseif(isset($fp)){$hcm='cmode:1,';}
//if(isset($_GET['m'])){$sm='mode:'.$_GET['m'].',';}
echo'</form></div><script type="text/javascript" src="inc/ajax/hit/js/bsn.Ajax.js"></script><script type="text/javascript" src="inc/ajax/hit/js/bsn.DOM.js"></script><script type="text/javascript" src="inc/ajax/hit/js/bsn.AutoSuggest.js"></script>
<script type="text/javascript">var options = {script:"inc/ajax/hit/hit.php?",varname:"input",minchars:1,'.$hbi.$hcm.$htm.'};var as = new AutoSuggest(\''.$dosho.'\', options);</script>';if(isset($nodiv)){echo'</div>';}
}
if(isset($fp)){ # and isset($dem2)
  //<b>_Get it at______</b><br>
  
 /*echo'<a href="http://www.hotscripts.com/listing/bible-scripture/?RID=N809529"><img src="http://cdn.hotscripts.com/listings/badge/125185-peppers.gif" alt="View our reviews on Hot Scripts" style="border: 0;" /></a>';
 echo' </a>
 <a href="https://freecode.com/projects/scripture"><img height="62" src="https://a.fsdn.com/fm/images/fm_logo.png"></a>';*/
 if(isset($dem2)){
  echo'<br>Project hosting platform provided by<br>
  <a href="http://sourceforge.net/projects/scripture/files/latest/download"><img src="http://sflogo.sourceforge.net/sflogo.php?group_id=522543&amp;type=4">';
 }
}
if(empty($mysqldatabasecreate)){mysql_close();}
echo$footer;
# licence: gpl-signature.txt?>