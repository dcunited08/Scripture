<?php
 if(empty($s_bk)and empty($firsttime)){if(!empty($book)){$s_bk=$book;} else{$s_bk="";} if(!isset($_GET['b']) or !empty($fp)){require('frontpage.php');}
  else{echo'No more chapters ';}
    $s_bk=mysql_result($rbk,($b_num3+1),'book');$chap='0';$mover="";
  }else{$mover='&ch=&#62;&#62;';}
if(!isset($_GET['b'])and empty($_GET['bookmark'])and empty($_GET['favorite'])and empty($_GET['note'])and!isset($emptyquery)){} // echo'<br>&#62;&#62;<br>';
  elseif(!isset($fp)and empty($se1)){echo '<a href="?bk='.$s_bk.$bl.$scrolll.'&c='.($chap+1).$typerdo.'">goto next book by clicking here</a> ';
  if(isset($mapspecific)){
      require('Languages/Filter_openbible.php');
      require('Languages/Filter_drupal.php');
      #$token=array_search(strtolower($book),$a_shortdrupal);
      $bkts=strtolower($book);$ia=0;foreach($a_shortdrupal as $key=>$ki){if($ki==$bkts){$token=$ia;break;}++$ia;}
      if(!strstr($a_shortopenbible[$token],'_')){
        $maplink='http://maps.google.com/maps?q=http%3A%2F%2Fa.openbible.info%2Fgeo%2Fkmls%2F';
        $maplink2=$a_shortopenbible[$token].'.'.$chap.'.kml&t=k';
	$maplink3=$a_shortopenbible[$token].'.kml&t=k';
      }
    }
  }
  if(!empty($num5)){
    if($num5 == '1'){echo N.$eddone.'<u>1 Verse</u>'.N;}else{echo N.$eddone.'<u>'.$num5.' Verses</u>'.N;}
    if(empty($nohighlight)and($mysettings[14] !== '2')and(empty($se1)or!preg_match('/(\()|(^\w*$)/i',$se1))){require('audiobible.php');}
    if(isset($maplink)){if(!isset($no_mobile)){echo N;}echo' <a href="'.$maplink.$maplink2.'">Chapter GeoMap</a>| <a href="'.$maplink.$maplink3.'">Book GeoMap</a>|';}
    $donate='1';
  }
?>