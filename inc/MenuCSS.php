<?php // licence: gpl-signature.txt
$bookli='&bk='.$book;
if(!isset($no_mobile)){echo'<td></tr><tr><td>';}
echo'<form action="index.php" method="get"><div id="menuh-container"><div id="menuh">
<b>'.$l_m4.'</b>(<a href="superdial.php?forum'.$bl.'">'.$l_m5.'</a>|<a href="'.$subd.'/bible_dial.php?bd'.$bl.'">'.$l_m6.
'</a>|<a href="'.$subd.'/bible_dial.php?bd'.$bl.'&hl">'.$l_m7.'</a>)<br>
<b>'.$l_m8.'</b>(<a href="'.$subd.'?mypage=1'.$bl.$bookli.'">'.$l_m9.'</a>|<a href="'.$subd.'?mydata=1'.$bl.$bookli.'">'
.$l_m10.'</a>|<a href="'.$subd.'?mydata=settings'.$bl.$bookli.'">'.$l_m11.'</a>|<a href="/users.php">'.$l_m12.'</a>)<br>
|<a href="advanced_search.php?b='.$b.'">'.$l_m13.'</a>|<a href="'.$subd.'?forum'.$bl.$bookli.'">'.$l_m14.
'</a>|<a href="/rss">RSS</a>|<a href="'.$subd.'?geo'.$bl.$bookli.'">Geo</a>|<a href="'.$subd.'?tv'.$bl.$bookli.
'">TV</a>|<a href="/chat">'.$l_m15.'</a></div></div></td><td>'; //<a href="'.$subd.'?groups=1'.$bl.$bookli.'">Groups</a> | //<a href="'.$subd.'?lookups=1'.$bl.$bookli.'">Lookup</a> |

if(!isset($no_mobile)){echo'<td></tr><tr><td>';}
else{echo' ';}
require('user_tools.php');
if(!empty($x1)){echo'<input type="submit" value="'.$l_m3.'">';}
if(($u==='demo')and(isset($no_mobile))){
 $new2='<br>';
 $new3='<br>|<a href="/?forum&nid=23">'.$l_m16.'</a>|<a href="users.php">'.$l_m17.'</a>|';
}

if(isset($fp)){
  echo'</td><td align="right"><img src="img/icon_gold.png">'.$new2.
  '</td><td><b>'.$mailer_name.'</b><br><sup>'.$l_m18.'</sup>'.$new3;
  $do_donate='1';
}
echo '</td></form>';
if(isset($no_mobile)and isset($do_donate)){echo'<td>';require('inc/donate.php');echo'</td>
<td><b>Links</b><br>
<a href="?rl=AHRC'.$bl.$bookli.'">AHRC</a><br>
<a href="?rl=Diagrams'.$bl.$bookli.'">Diagrams</td></form>';}
?>