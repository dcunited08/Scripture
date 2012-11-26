<?php // licence: gpl-signature.txt
if(empty($password)){require('init.php');}if($uid!=='1'){die('Access denied.');}
$bid=stripslashes($_GET['bid']);
$sbc='1';
if(empty($bid)){
  if($uid!=='1'){die('Please choose a bid, example: content_export.php?bid=1');}
  $sbc=mysql_result(mysql_query('SELECT count(bid) AS C FROM bible_list;'),0,'c');
  $sbc=($sbc + 2);
  ini_set('max_execution_time', '600');
  ini_set('post_max_size', '40M');
  ini_set('max_file_uploads', '40M');
  ini_set('max_input_time', '400');
}
if(!file_exists('mydata')) {mkdir('mydata');chmod('mydata',0755);}
if(!file_exists('mydata/bibles')) {mkdir('mydata/bibles');chmod('mydata',0755);}
/*$htfile='mydata/.htaccess';
if(!file_exists($htfile)) {fwrite(fopen($htfile, 'a'),"\n");}
      $userstamp = ' #%date: '.date("Y-m-d H:i:s").' %user: '.$u;
      $fh = fopen($htfile, 'a+') or die('can\'t open .htaccess'); */
$i2=1;while($i2<=$sbc){
      if(empty($bid)){$bid=$i2;}
        $cm=date('m');
        if(in_array($cm,array(01,02,03))){$qr=1;}
	elseif(in_array($cm,array(04,05,06))){$qr=2;}
	elseif(in_array($cm,array(07,08,09))){$qr=3;}
	elseif(in_array($cm,array(10,11,12))){$qr=4;}
      $personal_file = 'Bible_'.$bid.'y'.date("Y").'q'.$qr.'.bc';
      $bcheck=mysql_query('SELECT bsn,global AS C FROM bible_list where bid='.$bid);
      $bcheck2=mysql_result($bcheck,0,'bsn');
      if(empty($bcheck2)){unset($bid); ++$i2; next;}
      if(($uid!=='1')and(mysql_result($bcheck,0,'global')!=='1')){die('Access denied, This is not a public bible');}
      /*$f_arr = file($htfile); echo fread($fh,count($f_arr));
      fwrite($fh, "\n<FilesMatch \"".$personal_file."$\">".$userstamp."\nOrder deny,allow\nDeny from all\nAllow from ".$remoteaddr."\n</FilesMatch>\n".$userstamp);
      fclose($fh); */
      // <- .htaccess
      if(($bid=='6')and($uid!=='1')){die('access denied');}
      if (file_exists('mydata/bibles/'.$personal_file)) { die('file already exists'); }//unlink('mydata/'.$personal_file);
      $fh = fopen('mydata/bibles/'.$personal_file, 'a+') or die('Unable to open target location');
      fwrite($fh, pack('CCC',0xef,0xbb,0xbf));
      $personal_dbs = array('bible_xrefs', 'bible_notes', 'bible_favorites', 'bible_bookmarks');
      $r=mysql_query('select * from bible_list where bid='.$bid);
      fwrite($fh,"*Bible\r\n#shortname fullname language\r\n".mysql_result($r,0,'bsn').'|'.mysql_result($r,0,'bname').'|'.mysql_result($r,0,'lang')."\r\n\r\n*Chapter\r\n#book,fullname,shortname,chap-count\r\n");
      $r=mysql_query('select * from bible_book_name where bid='.$bid.' order by bkid');
      $n=mysql_numrows($r);
      $i=0;while($i<$n){
	fwrite($fh,mysql_result($r,$i,'book').'|'.mysql_result($r,$i,'fname').'|'.mysql_result($r,$i,'sname').'|'.mysql_result($r,$i,'chap')."\r\n");
	++$i;
      }
      fwrite($fh,"\r\n*Context\r\n#Book,Chapter,Verse,LineMark,Context\r\n");
      $r=mysql_query('select * from bible_context where bid='.$bid.' order by vsid');
      $n=mysql_numrows($r);
      $i=0;while($i<$n){
	$cx=mysql_result($r,$i,'context');
	if(strstr($cx,'&')){$cx=str_replace(array('&#039;','&quot;','&lt;','&gt;'),array("'",'"','<','>'),$cx);}
	fwrite($fh,mysql_result($r,$i,'book').'|'.mysql_result($r,$i,'chapter').'|'.mysql_result($r,$i,'verse').'||'.$cx);
	++$i;
      }
    fclose($fh);
    echo$personal_file.' <a href=\'mydata/bibles/'.$personal_file.'\'>Generation complete, click here to download.</a><br>';
    unset($bid); ++$i2;
}  
// licence: gpl-signature.txt?>