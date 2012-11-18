<?php // licence: gpl-signature.txt
//if(isset($_GET['csstest'])){$thid='3';}
$th=mysql_query('SELECT * FROM bible_themes where tid='.$thid);
$fontcolor=mysql_result($th,'0','fontcolor');
  if(!empty($fontcolor)){$fontcolor='color:'.$fontcolor.';';}
$fontbackground=mysql_result($th,'0','fontbackground');
  if(!empty($fontbackground)){$fontbackground='background-color:'.$fontbackground.';';}
$fontsize=mysql_result($th,'0','fontsize');
  if(!empty($fontsize)){$fontsize='font-size:'.$fontsize.'%;';}
if($fontsize ==='0'){unset($fontsize);}
$versehighlightcolor=mysql_result($th,'0','versehighlightcolor');
  if(!empty($versehighlightcolor)){$versehighlightcolor=$versehighlightcolor;}
$fontface=mysql_result($th,'0','font');
  if(!empty($fontface)){$fontface='font:'.$fontface.';';}
$lfweight=mysql_result($th,'0','lfweight');if(!empty($lfweight)){$lfweight='font-weight:'.$lfweight.';';}
$lback=mysql_result($th,'0','lback');if(!empty($lback)){$lback='background-color:'.$lback.';';}//text-align:center;
$ldisp=mysql_result($th,'0','ldisp');
$vlcolor=mysql_result($th,'0','visitedlinkcolor');if(!empty($vlcolor)){$vlcolor='a:visited{color:'.$vlcolor.';}';}
$alcolor=mysql_result($th,'0','activelinkcolor');
if(!empty($alcolor)and empty($ldisp)){$alcolor='a:active{background-color:'.$alcolor.';}';}
elseif(!empty($alcolor)){$alcolor='background-color:'.$alcolor.';';}
$lcolor=mysql_result($th,'0','linkcolor');
if(!empty($lcolor)and empty($ldisp)){$lcolor='a:link{color:'.$lcolor.';}';}
elseif(!empty($lcolor)){$lcolor='color:'.$lcolor.';';}
if(!empty($ldisp)){
  $ldisp='input,select,.tme{display:inline-block;background-color:#1E4A56;color:#709FA0;padding-right:3px;border:1px solid;padding-left:3px;}
	  u{font-weight:bold;color:#CFB52B;}hr{border:1px dotted #70AA93;}.go{text-decoration:blink;background:#586041;color:#CFB52B;}
	  a:link,a:visited{text-decoration:none;display:'.$ldisp.';'.$lback.$lfweight.$lcolor.$alcolor.'padding-right:2px;border:1px solid;padding-left:2px;}';
  unset($lcolor,$alcolor);
}
$alhov=mysql_result($th,'0','lhover');if(!empty($alhov)){$alhov='a:hover{background-color:'.$alhov.';}';}
?>