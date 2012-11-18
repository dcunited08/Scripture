<?php # licence: gpl-signature.txt
//if(isset($_GET['csstest'])){$thid='3';}
$th=mysql_query_s('SELECT * FROM '.$database.'.bible_themes where tid='.$thid);
$genfp=mysql_result($th,'0','genfp');$gen=mysql_result($th,'0','gen');
if(isset($fp)){$stylef='inc/style/'.$thid.'fp.css';}
else{$stylef='inc/style/'.$thid.'.css';}
$fontcolor=mysql_result($th,'0','fontcolor');if(!empty($fontcolor)){$fontcolor='color:'.$fontcolor.';';}
$fontbackground=mysql_result($th,'0','fontbackground');if(!empty($fontbackground)){
  $fontbackground='background-color:'.$fontbackground.';';
}//$fontbackground='background-image: linear-gradient(bottom, rgb(12,94,200) 47%, rgb(39,123,240) 74%);';
$fontsize=mysql_result($th,'0','fontsize');if($fontsize ==='0'){unset($fontsize);}if(!empty($fontsize)){$fontsize='font-size:'.$fontsize.'%;';}
$fontface=mysql_result($th,'0','font');if(!empty($fontface)){$fontface='font:'.$fontface.';';}
$lfweight=mysql_result($th,'0','lfweight');if(!empty($lfweight)){$lfweight='font-weight:'.$lfweight.';';}
$lback=mysql_result($th,'0','lback');if(!empty($lback)){$lbac=$lback;$lback='background-color:'.$lback.';';}//text-align:center;
$ldisp=mysql_result($th,'0','ldisp');
$vlcolor=mysql_result($th,'0','visitedlinkcolor');if(!empty($vlcolor)){$vlcolor='a:visited{color:'.$vlcolor.';}';}
$alcolor=mysql_result($th,'0','activelinkcolor');
$versehighlightcolor=mysql_result($th,'0','versehighlightcolor');
$isadv=strstr($_SERVER['SCRIPT_NAME'],'advanced_search.php');
#if(!isset($nodiv)&&isset($no_mobile)and (isset($fp) or !empty($isadv) or isset($_GET['forum']))){
if(isset($fp)){//8C888C 9F8874
  //if(empty($isadv)){$dival='text-align:center;';}
  $boardcol=mysql_result($th,'0','boardcol'); $divback=mysql_result($th,'0','divback'); $ufp=mysql_result($th,'0','ufp');
  $tableback=mysql_result($th,'0','tableback');$alfp=mysql_result($th,'0','alfp');
  /*if(empty($boardcol)){$boardcol='#727053';}
  if(empty($divback)){$divback='#9F8F74';}
  if(empty($ufp)){$ufp='#777661';}
  if(empty($tableback)){$tableback='#4C92B5';}
  if(empty($alfp)){$alfp='#828E76';}*/
  if(!empty($tableback)){$tableback2='table{border-color:'.$boardcol.';background-color: '.$tableback.'}';}
  $nmtheme='div{'.$dival.'background-color: '.$divback.'; 
  border: solid 1px '.$boardcol.'; }'.$tableback2;
  if(!empty($alfp)){$alcolor=$alfp;}//808E7A 84967E 91878B
  if(!empty($ufp)){$ufp='background-color: '.$ufp.';';}//84878B
  
  //$fcen='form{text-align:center;}';
}//#747455
/*if(isset($no_mobile)){
  if(!empty($boardcol)){$bodymargin='margin:0px 30px;border:1px solid '.$boardcol.';';}
  $topmargin='margin-top:12px;';
}*/
if(!empty($alcolor)and empty($ldisp)){$alcolor='a:active{background-color:'.$alcolor.';}';}elseif(!empty($alcolor)){$alcolor='background-color:'.$alcolor.';';}
$lcolor=mysql_result($th,'0','linkcolor');
$alhov=mysql_result($th,'0','lhover');if(!empty($alhov)){$ihover='input:hover{background-color:'.$alhov.';}';$alhov='a:hover,input:hover,select:hover{background-color:'.$alhov.';}';}
$ucol=mysql_result($th,0,'ucol');if(!empty($ucol)){$ucol='u{font-weight:bold;color:'.$ucol.';'.$ufp.'}';}
$hcol=mysql_result($th,0,'hcol');if(!empty($hcol)){$hcol='hr{border:1px solid '.$hcol.';}';}
$gcol=mysql_result($th,0,'gcol');if(!empty($gcol)){$gcol='color:'.$gcol.';';}
$gback=mysql_result($th,0,'gback');if(!empty($gback)){$gback='background-color:'.$gback.';';}
$gdec=mysql_result($th,0,'gdec');if(!empty($gdec)){$gdec='.go{'.$gcol.$gback.'text-decoration:'.$gdec.';}';}
$scol=mysql_result($th,0,'scol');if(!empty($scol)){$scol='sup{color:'.$scol.';}';}
$lca=$lcolor;

$bmcol=mysql_result($th,0,'bmcol');if(!empty($bmcol)){$dbmcol='a.bmcol,a.bmcol:visited{color:'.$bmcol.';}';}
$notcol=mysql_result($th,0,'notcol');if(!empty($notcol)){$dnotcol='a.notcol,a.notcol:visited{color:'.$notcol.';}';}
$favcol=mysql_result($th,0,'favcol');if(!empty($favcol)){$dfavcol='a.favcol,a.favcol:visited{color:'.$favcol.';}';}
$xrefcol=mysql_result($th,0,'xrefcol');if(!empty($xrefcol)){$dxrefcol='a.xrefcol,a.xrefcol:visited{color:'.$xrefcol.';}';}
$tocol=mysql_result($th,0,'tocol');if(!empty($tocol)){$dtocol='a.tocol,a.tocol:visited{color:'.$tocol.';}';}

if(!empty($lcolor)and empty($ldisp)){$lcolor='a:link{color:'.$lcolor.';}';}
elseif(!empty($lcolor)){$lcolor='color:'.$lcolor.';';}
if(!isset($badbrowse)){$idisp=mysql_result($th,0,'idisp');}else{$idisp='inline';$ldisp=$idisp;}
if(!empty($idisp)){$iback=mysql_result($th,0,'iback');$icol=mysql_result($th,0,'icol');
  $idisp='input,select,.tme,textarea{font-weight:bold;display:'.$idisp.';background-color:'.$iback.';color:'.$icol.';margin-left:2px;padding-right:1px;border:1px solid;padding-left:1px;}';
}//u 372E15 //go_B:586041 GcolB:C5B356 //2: background-color:#1E4A56; 726648 color:#709FA0;   //old color input: 80934F
if(isset($fp)){$fpborder='border:1px solid'.$boardcol.';';}
if(!empty($ldisp)){
  $ldisp='a:link,a:visited{text-decoration:none;display:'.$ldisp.';'.$fpborder.$lback.$lfweight.$lcolor.$alcolor.'padding:0px;padding-right:1px;padding-left:1px;}';#  #margin-top:3em;
  unset($lcolor);
}//margin-top:1px; //old gold:CFB52B //old hrcol:635924
/*

<input class="ui-autocomplete-input"/>
<ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all">
  <li class="ui-menu-item">
    <a class="ui-corner-all">item 1</a>
  </li>
  <li class="ui-menu-item">
    <a class="ui-corner-all">item 2</a>
  </li>
  <li class="ui-menu-item">
    <a class="ui-corner-all">item 3</a>
  </li>
</ul>


//old body: padding:0;

@font-face {
   font-family: "Proto-Semitic";
   src: local("Proto-Semitic");
   unicode-range: U+05D0-05EC;
}
span {
   font-family: "Proto-Semitic";font-size: 12ex;
}

*/
if((((isset($fp) and empty($genfp))or(empty($gen)and!isset($fp))) or (!is_file($stylef)))and($link!==FALSE)){
$fh2=fopen($stylef,'w+');#<style type="text/css">
fwrite($fh2,'zx{color:'.$versehighlightcolor.';}
       @font-face {font-family: "Proto-Semitic";src: local("Proto-Semitic");unicode-range: U+05D0-05EC;}
       zxx{font-family:"Proto-Semitic";}
       body{position:relative;'.$fontbackground.$fontsize.$fontcolor.$fontface.$bodymargin.$topmargin.'}
       select.ss{width:10px;}'.$lcolor.$vlcolor.$ldisp.$idisp.$alhov.$ucol.$hcol.$gdec.$scol.$imgs.$nmtheme.$fcen);
//if(isset($docss)){require('inc/css_menu.php');}
if(!isset($fp)){
  $dofpcol="";#  $dbmcol $dnotcol $dfavcol
  if(isset($dbmcol)){$dofpcol.=$dbmcol;}
  if(isset($dnotcol)){$dofpcol.=$dnotcol;}
  if(isset($dfavcol)){$dofpcol.=$dfavcol;}
  if(isset($dxrefcol)){$dofpcol.=$dxrefcol;}
  if(isset($dtocol)){$dofpcol.=$dtocol;}
  fwrite($fh2,$dofpcol);
}
if(!isset($nohits_removethis)and ($link!==FALSE)){fwrite($fh2,'
.ui-menu { border:1px solid #999; background:#FFF; cursor:default; text-align:left; max-height:550px; overflow:auto; margin:-0px 0px 0px -0px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
ul.autosuggest{position: absolute;list-style: none;margin: 0;padding: 0;}
	ul.autosuggest li a:link,
	ul.autosuggest li a:visited
	{
		display: block;
		text-decoration: none;
		background-color: #eee;
	}

	ul.autosuggest li a:hover,
	ul.autosuggest li a:active
	{
		color: #fff;
		background-color: #f30;
	}
');}
#fwrite($fh2,'</style>');
fclose($fh2);
if(isset($fp)){mysql_query('UPDATE '.$database.'.bible_themes SET genfp=1 where tid='.$thid);}
else{mysql_query('UPDATE '.$database.'.bible_themes SET gen=1 where tid='.$thid);}
}
echo'<link type="text/css" rel="stylesheet" href="'.$stylef.'">';
unset($idisp,$icol,$iback,$gdec,$gcol,$gback,$ucol,$hcol,$scol);
?>