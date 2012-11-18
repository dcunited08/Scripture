<?php
require('../init.php');
?>
<center>
<form method="GET" action="http://webchat.freenode.net" name="loginform">
<p><b>Welcome to Bible Chat.</b></p>
<u>Your Nickname</u><br>
<input type="text" name="nick" value="BW_U<?php echo rand(100, 4000) ?>"><br>
<input type="hidden" name="channels" value="#BibleWay"><br>
<input type="hidden" name="uio" value="OT10cnVlJjExPTgyJjEyPXRydWU83">
<input type="submit" value=" Click here to go to the chat ">
</form>

<a href="http://www.wsirc.mobi/?username=bw_******&server=irc.freenode.net&channel=%23BibleWay&autojoin=true&color=%23D3DDE2&dark=false">Or click here to use another site.</a><br>
<?php
if(isset($_GET['FungerendeKlient'])) {echo '<a href=""><img src="FungerendeKlient.jpg"></a>';}
else {echo '<a href="?FungerendeKlient">Picture of how it will look like when it works</a>';}
?>

<?php
if(isset($_GET['alternativ'])) {
  echo '<p>A alternative way of connecting is to download a irc client. For windows would <a href="http://www.mirc.com">mIRC</a> be optimal. <br>
When starting up mIRC write: /server irc.freenode.net To connect to the server where we are. <br>
To get into the channel/forum/room we are, write: /j bibleway </p></p>
<p><a href="http://irchelp.org/irchelp/mac/">List over IRC clients for Mac</a><br>
<a href="http://www.linuxhaxor.net/?p=755">List over IRC clients for Linux</a></p><br>
<a href="http://mirggi.net">Symbian</a><br>
<a href="http://www.andchat.net">Android</a> 
<br>';
}
else {echo '<p><a href="?alternativ">Alternative connection ways</a></p>';}
?>
</center></body></html>