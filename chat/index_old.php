<title>Bible Chat</title>
<meta http-equiv="Content-Type" content="text/html; utf-8" />

<link rel="SHORTCUT ICON" href="/favicon.ico">
<script language="JavaScript"><!--
function setjs() {
if(navigator.product == 'Gecko') {
  document.loginform["interface"].value = 'mozilla';
}else if(navigator.appName == 'Microsoft Internet Explorer' &&
navigator.userAgent.indexOf("Mac_PowerPC") > 0) {
  document.loginform["interface"].value = 'konqueror';
}else if(navigator.appName == 'Microsoft Internet Explorer' &&
document.getElementById && document.getElementById('ietest').innerHTML) {
  document.loginform["interface"].value = 'ie';
}else if(navigator.appName == 'Konqueror') {
  document.loginform["interface"].value = 'konqueror';
}else if(window.opera) {
  document.loginform["interface"].value = 'mozilla';
}}
//--> <input type="hidden" name="Port" value="8080"> //http://79.143.177.152/cgi-bin/cgiirc/irc.cgi
</script>
<center>
<form method="post" action="http://irc.kanotix.net/cgi-bin/cgiirc/irc.cgi" name="loginform" onsubmit="setjs();return true;" id="ietest">
<p><b>Welcome to Bible Chat.</b></p>
<u>Your Nickname</u><br>
<input type="hidden" name="interface" value="nonjs">
<input type="hidden" name="Server" value="irc.freenode.net">
<input type="hidden" name="Realname" value="CGI:IRC User">
<input type="hidden" name="Format" value="mirc">
<input type="text" name="Nickname" value="sGuest<?php echo rand(100, 4000) ?>"><br>
<input type="hidden" name="Channel" value="#sproj"><br>
<input type="hidden" name="timestamp" value="1">
<input type="hidden" name="smilies" value="1">
<input type="hidden" name="shownick" value="1">
<input type="hidden" name="font" value="Fixedsys">
<input type="submit" value=" Click here to go to the chat ">
</form>
If it doesn't work, go back and try again.<br>
<a href="http://www.wsirc.mobi/?username=sf_******&server=irc.freenode.net&channel=%23sproj&autojoin=true&color=%23D3DDE2&dark=false">Or click here to use another site.</a><br>
<?php
if(isset($_GET['FungerendeKlient'])) {echo '<a href=""><img src="FungerendeKlient.jpg"></a>';}
else {echo '<a href="?FungerendeKlient">Picture of how it will look like when it works</a>';}
?>

<?php
if(isset($_GET['alternativ'])) {
  echo '<p>A alternative way of connecting is to download a irc client. For windows would <a href="http://www.mirc.com">mIRC</a> be optimal. <br>
When starting up mIRC write: /server irc.freenode.net To connect to the server where we are. <br>
To get into the channel/forum/room we are, write: /j sproj </p></p>
<p><a href="http://irchelp.org/irchelp/mac/">List over IRC clients for Mac</a><br>
<a href="http://www.linuxhaxor.net/?p=755">List over IRC clients for Linux</a></p><br>
<a href="http://mirggi.net">Symbian</a> 
<br>';
}
else {echo '<p><a href="?alternativ">Alternative connection ways</a></p>';}
?>
</center>