<?php
$viewmap=urldecode(stripslashes($_GET['f']));
if(empty($viewmap)){$viewmap='1/Scripture.mm';}
echo'<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Mindmap: </title>
<script type="text/javascript" src="./inc_files/flashobject.js"> </script><style type="text/css">
html{height:100%;overflow:hidden;}
#flashcontent{height: 100%;}
body{height:100%;margin:0;padding:0;background-color: #ffffff;}
</style></head>
<body>
<div id="flashcontent">
		 Flash plugin or Javascript are turned off.
		 Activate both  and reload to view the mindmap
	</div>
<script type="text/javascript">
		var fo = new FlashObject("./inc_files/visorFreeplane.swf", "visorFreeplane", "100%", "100%", 8);
		fo.addParam("quality", "high");
		fo.addVariable("bgcolor", 0xffffff);
		fo.addVariable("openUrl", "_blank");
		fo.addVariable("initLoadFile", "./'.$viewmap.'");
		fo.addVariable("startCollapsedToLevel","5");
		fo.write("flashcontent");
	</script>
</body>
</html>';

?>