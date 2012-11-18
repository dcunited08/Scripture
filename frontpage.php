<?php // licence: gpl-signature.txt
if(($u==='demo')and(isset($no_mobile))){$dem='1';$dem2='1';
$ustyle=' style="text-align:center;display:block;" ';
echo'<hr><u '.$ustyle.'>Our features</u><hr><table border="1" width="100%">
<tr align="center"><td><b>Strong<br>
Interlinear<br>
Favorites, Bookmarks and Notes</b><br>
Crossreferences and <b>User-Crossreferences<br>
Negate Search</b> Example: Blessed are -Love<br>
<b>Or</b>: Blessed|cursed/loved\thou are -Love !sin<br>
<b>Specials, t: these words, p: exact phrase, b: begins with,e: ends with<br>
Paraphrased Search</b> with editor<br>
Search <b>Between</b> verses, books and chapters<br>
Book specific: Blessed are -Love mat()<br>
Regex Search, r: ^love -hatred<br>
<b>Multiverses</b> example: .mat 5:1-11 .mat 28:20 .1jo 5:1-4<br>
<b>Opensource PHP</b> <a href="http://sourceforge.net/projects/scripture/files/latest/download">Download for free and join the development</a><br>
</td><td>
Search and lookup <b>History</b><br>
Multi-categorical <b>Forum, Blogg, Articles, Podcast..</b><br>
Strongs display modes: listboxes, tooltip and link<br>
Editors: <b>CKeditor</b> and <b>TinyMCE</b><br>
Bible <b>Dialer</b> and Topic <b>Map editor</b><br>
Styles and <b>Theme Editor</b><br>
Language Note Interpretor for Greek<br>
<b>Shares</b>: notes, crossreferences and favorites<br>
Bible Exporters<br>
IRC <b>Chat<br>
RSS</b><br>
Geographical visitor stats<br>
Ancient Hebrew
</td></tr></table>';}
//elseif($u==='demo'){$dem='1';echo N.'<a href="/?forum&nid=23">Are you new?<br>Click here</a>'.N;}
if(isset($dem)){echo '<hr width="100%">';}
if ($mysettings[11] > '1') {
 $s=' promote=1 and status=1 AND type NOT IN(\'fc\',\'ct\')';
 $s=mysql_query('SELECT visitors,nid,title,data,type,uid,created,category,uppercat FROM bible_nodes WHERE '.$s.' ORDER BY field(type,\'ne\'),type,sticky,created DESC LIMIT 0,21;');
 require('inc/forum_view.php');
 $s=mysql_query('SELECT title,data,uid,created,category FROM bible_nodes WHERE type=\'ct\' ORDER BY created DESC LIMIT 0,4;');
 $n=mysql_numrows($s);
 echo'<u '.$ustyle.'>Latest Comments</u><hr>';
 if($n>0){echo'<table border="1">';}//<td>Title:<br>Thread:<br>Time[U]:</td>';}
 if(isset($no_mobile)){echo'<tr>';}
 $i=0;while($i<$n){
   $scate=mysql_result($s,$i,'category');
   if(!isset($no_mobile)){echo'<tr>';}
   echo'<td><a href="?forum&comments=1&nid='.$scate.'&b='.$b.'&s='.$se.'">'.mysql_result($s,$i,'title').'</a><br>'.mysql_result(mysql_query('SELECT title FROM bible_nodes WHERE nid='.$scate),0,'title').'<br>'.date('dMy H:i', mysql_result($s,$i,'created')).'['.mysql_result($s,$i,'uid').']</td>';
   if(!isset($no_mobile)){echo'</tr>';}
   ++$i;
 }if(isset($no_mobile)){echo'</tr>';}
 echo'</table><hr>';
}

if(!empty($fp)){echo'  <a href="mailto://'.$website_email.'">Contact Us</a> &#169; 2011→2012; General Public Licence; '.'Find us on(<a href="http://sourceforge.net/projects/scripture">Sourceforge</a>,<a href="https://freecode.com/projects/scripture">Freecode</a>,<a href="http://www.hotscripts.com/listing/bible-scripture/?RID=N809529">HotScripts</a>)';}

if(!empty($fp)and($u=='demo')){require('inc/footer.php');}
?>