<?php // licence: gpl-signature.txt
if(empty($password)){require('../init.php');}
//if($uid!=='1'){die('access denied.');}
if (empty($_GET['stse'])) {
echo'<p><form action="index.php?b='.$b.'&bk='.$book.'&c='.$chap.'" method="post" enctype="multipart/form-data">
<u>References found in current book</u><br><select style="width:195" name="lookup">';
if (!empty($_GET['b'])) { $bspecific=" AND book='$book' ";$bspecific2=" WHERE book='$book' ";}
elseif ($uid=='1') {ini_set('max_execution_time', '600');$lister='1';$listerdata="";$bspecific="";} // "AND bid='9'"
if (isset($_GET['bib'])) {
  if($uid=='1'){$lister='1';}
  $bspecific3=" and bid=".$_GET['bib']." ";
  $bspecific4=" where bid=".$_GET['bib']." ";$bspecific="";
  if(empty($bspecific2)){$bspecific5=$bspecific4;}
  else{$bspecific5=$bspecific3;}
  
}
$fsql='SELECT * FROM bible_headlines'." $bspecific2 $bspecific5".' ORDER BY hid ASC';
//echo $fsql;
$fsqlq=mysql_query($fsql);
$check=mysql_result($fsqlq,7,'verse');
if (empty($check)){
  if($uid!=='1'){$nohldb='1';}
  $fsqlmain='SELECT * FROM bible_context WHERE context REGEXP binary'." '^[\[][A-ZÆØÅ&;a-zæøå ][A-ZÆØÅ&;a-zæøå ][^\]]*\]' $bspecific3 $bspecific ORDER BY vsid ASC";
  $fsqlq=mysql_query($fsqlmain);
}else{$nonew='1';}
  $n=mysql_numrows($fsqlq);
  echo "\r\n".$check."\r\n".'_'.$nohldb.'_num: '.$n.' '.$fsql."\r\n".$fsqlmain.N.'no new: '.$nonew.N;
  $i=0;while($i<=$n){
    $sverse=mysql_result($fsqlq,$i,'verse');
    if((isset($bspecific)and!isset($sbidh))or!isset($bspecific)){$sbidh=mysql_result($fsqlq,$i,'bid');}
    if (empty($nohldb)) {
      if(!isset($nonew)){$schap=mysql_result($fsqlq,$i,'chapter');}
      else{$schap=mysql_result($fsqlq,$i,'chap');}
      $sbook=mysql_result($fsqlq,$i,'book');
      if(!isset($nonew)){
        $scontext=substr(mysql_result($fsqlq,$i,'context'),0,100);
        $scontext=explode(']',$scontext);
        $scontext=str_replace('[','',$scontext[0]);
      }
      else{$stit=mysql_result($fsqlq,$i,'title');}
      if(!empty($scontext) && !preg_match('/(\d)|(KJV\:)/',$scontext)) {//|([a-z])
        //$schap=mysql_result($fsqlq,$i,'chapter');
        //echo '<option value="'.$book.' '.$schap.':'.$sverse.'">'.$scontext.'</option>';d
        if (!empty($lister)) {
            //$sbook=mysql_result($fsqlq,$i,'book');
            if (($i<='1')&&!empty($scontext)) {
                $dosql='SELECT * FROM bible_headlines WHERE title='."'$scontext' AND book='$sbook' AND chap='$schap' AND verse='$sverse';";
                $fsqlqt=mysql_query($dosql);
                $dosql=mysql_result($fsqlqt,0,'title');
                if (!empty($dosql)){$nonew='1';}
            }
            //if (strlen($scontext) > $listerdata) { $listerdata=strlen($scontext);}
            if(!empty($scontext)){
              $dosql='INSERT INTO bible_headlines (hid,title,book,chap,verse,bid) values (NULL,'."'$scontext','$sbook','$schap','$sverse','$sbidh');";
              if(empty($nonew)) { $fsqlqt=mysql_query($dosql); }
              }
            //$listerdata.=$scontext.' '.$sbook.' '.$schap.':'.$sverse.'<br>';
        }
        $stit=$scontext;
      }
    }
    if(!empty($stit)){
      echo '<option value="'.$sbook.' '.$schap.':'.$sverse.'">'.$stit.' '.$sbidh.'</option>';
    }
    unset($scontext,$stit);
    ++$i;
  }
echo'</select><input type="submit" value="Go"></form></p>';
}
?>