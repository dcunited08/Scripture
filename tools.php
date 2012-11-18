<?php // licence: gpl-signature.txt
echo '<br>';
require('inc/user_tools.php');
//echo "<a href=".$_SERVER['PHP_SELF']."?s=".$bl."&bk=".$s_bk."&ch=&#62;&#62;&c=".$chap.">&#62;&#62;</a><br>";
//echo "<a href=\"\">Home</a> ";
echo'<br><a href="http://scripture.sf.net/chat">Chat</a>
	 <a href="?mypage=1'.$bl.'&chap='.$chap.'&bk='.$book.'">myPage</a> 
	<a href="?lookups=1'.$bl.'&chap='.$chap.'&bk='.$book.'">Lookup</a>';
$logindbcheck = mysql_query_s("show tables like 'node_type'");
$logindbcheck = mysql_numrows($logindbcheck);
if(empty($mode_drupall)){echo' <a href="users.php?&chap='.$chap.$bl.'&bk='.$book.'">Login</a>'; }
else{echo' <a href="'.$logiurl.'?q=/user/login">Login</a>'; }
// <- Bookmark list // preg_replace(array('/\s/','/\:/'),array('/\%20/','/\%3A/')
// licence: gpl-signature.txt?>