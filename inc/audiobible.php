<?php # licence: gpl-signature.txt
    if(!file_exists('audiobible')){require('generator_audiobook.php');echo N.'Generating Audiobible.'.N;}
    $g=strtolower($b_name3);
    require('Languages/Fullnames_eng.php');
    $fh=file('inc/audiobible/'.$bo.'.m3u');
    $slink=$fh[($chap-1)];
    if(!empty($slink)){ //urlencode($slink)
        if(!isset($no_mobile)){echo NN;} //bgcolor #CFB52B //bgcolor1 272B1D bgcolor2 272B1D
        echo ' <object type="application/x-shockwave-flash" data="inc/player_mp3_maxi.swf" width="200" height="20">
    <param name="movie" value="inc/player_mp3_maxi.swf">
    <param name="bgcolor" value="'.$boardcol.'">
    <param name="FlashVars" value="mp3='.urlencode($slink).'&amp;bgcolor1='.str_replace('#',"",$lbac).'&amp;bgcolor2='.str_replace('#',"",$alfp).'&amp;slidercolor1=CFB52B&amp;slidercolor2=CFB52B&amp;buttoncolor=CFB52B&amp;buttonovercolor=8DA859&amp;textcolor=8DA859">
    </object>';// bgcolor1=CFB52B&amp;bgcolor2=9F9F5F  loadingcolor=CFB52B&amp;bgcolor=CFB52B&amp; //BG1:2F4F2F
    if($uid==0){echo'<-{Click here to <u>Listen</u> to audio-recording}';}
    //elseif($uid==1){echo' bc:'.$boardcol.' lca:'.$lca.' alfp:'.$alfp.' db:'.$divback.' lbac:'.$lbac;}
    }
    unset($fh);

?>