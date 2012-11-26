<?php # licence: gpl-signature.txt
    if(!file_exists('audiobible')){require('generator_audiobook.php');echo N.'Generating Audiobible.'.N;}
    $g=strtolower($b_name3);
    require('Languages/Fullnames_eng.php');
    if(!isset($_GET['playall'])){
    $fh=file('inc/audiobible/'.$bo.'.m3u');
    $slink=str_replace("\r","",$fh[($chap-1)]);
    $slink=str_replace("\n","",$slink);
    }
    else{$slink='inc/audiobible/'.$bo.'.m3u';}
 if(!empty($slink)){
    if(!isset($no_mobile)){echo NN;}
    if(!isset($iphone)and!isset($_GET['playall'])){ //urlencode($slink)
         //bgcolor #CFB52B //bgcolor1 272B1D bgcolor2 272B1D
         if(!isset($_GET['playall'])){$slink=urlencode($slink);}
        echo ' <object type="application/x-shockwave-flash" data="inc/player_mp3_maxi.swf" width="200" height="20">
    <param name="movie" value="inc/player_mp3_maxi.swf">
    <param name="bgcolor" value="'.$boardcol.'">
    <param name="FlashVars" value="mp3='.$slink.'&amp;bgcolor1='.str_replace('#',"",$lbac).'&amp;bgcolor2='.str_replace('#',"",$alfp).'&amp;slidercolor1=CFB52B&amp;slidercolor2=CFB52B&amp;buttoncolor=CFB52B&amp;buttonovercolor=8DA859&amp;textcolor=8DA859">
    </object>';// bgcolor1=CFB52B&amp;bgcolor2=9F9F5F  loadingcolor=CFB52B&amp;bgcolor=CFB52B&amp; //BG1:2F4F2F
    if($uid==0){echo'<-{Click here to <u>Listen</u> to audio-recording}';}
    //elseif($uid==1){echo' bc:'.$boardcol.' lca:'.$lca.' alfp:'.$alfp.' db:'.$divback.' lbac:'.$lbac;}
    }else{echo'
    <audio controls="controls">
  <source src="'.$slink.'" type="audio/mpeg">
Your browser does not support the audio element.';#<audio src="'.$slink.'" type="audio/mpeg"></audio>
if(!isset($_GET['playall'])){echo'</audio> <a href="/?'.$_SERVER['QUERY_STRING'].'&playall">Play entire book</a>';}
    }
 }
 unset($fh);
?>