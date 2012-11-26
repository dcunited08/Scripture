<?php // licence: gpl-signature.txt
    $channel=stripslashes($_GET['chan']);$remotetype='tv';
    if(isset($_GET['rl'])){$channel=stripslashes($_GET['rl']);$remotetype='websites';}
    if(!empty($channel)and($remotetype=='tv')){
        echo'<iframe WIDTH="100%" HEIGHT=600 SRC="http://'.$_SERVER['HTTP_HOST'].'/inc/'.$remotetype.'/'.$channel.'.html">'.NN;
    }
    elseif(!empty($channel)){
        if($channel=='AHRC'){$channel='ancient-hebrew.org';}
        elseif($channel=='Diagrams'){$channel='teachinghearts.org';}
        elseif($channel=='glc'){$channel='www.godslearningchannel.com/site/live.php';}
        echo'<iframe WIDTH="100%" HEIGHT=600 SRC="http://'.$channel.'">'.NN;
    }
    if($remotetype=='tv'){
     echo'<u>TV Channels</u>'.NN.'<b>Carnal Party Specific</b><br>
     Human Adventist Denomination<br>
      <a href="'.$subd.'?tv'.$bl.$bookli.'&chan=adtv">Amazing Discoveries TV</a><br>
      <a href="'.$subd.'?tv'.$bl.$bookli.'&chan=htv">Hope Channel</a>
      '.NN.'<b>Charismatic</b>'.N.
      '<a href="'.$subd.'?tv'.$bl.$bookli.'&chan=bdtv">Bible Discovery TV</a><br>
      <a href="'.$subd.'?tv'.$bl.$bookli.'&chan=gtvus">God TV(us)</a>';
      echo NN.'<b>Uncategorized</b><br>
      <a href="'.$subd.'?tv'.$bl.$bookli.'&chan=gtvbs">God.tv Biblestudy</a><br>
      <a href="'.$subd.'?tv'.$bl.$bookli.'&rl=glc">God\'s Learning Channel</a><br>';
      //<a href="'.$subd.'?tv'.$bl.$bookli.'&chan=htvn">Hope Channel(Norwegian)</a>
    }
?>