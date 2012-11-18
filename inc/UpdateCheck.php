<?php // licence: gpl-signature.txt
echo'<a href="inc/generator_headlines.php?bib='.$b.'">Generate Headline List</a>'.N;
      $tmpfilename='http://scripture.sourceforge.net/updatecheck.php';
      require('inc/RemoteDownload.php');
    $updatesfound ="";
    foreach($lines as $fc){
      $token=explode(':',urldecode($fc));
      if(!empty($token[0])and(sha1_file(substr($token[0],0,40))!==substr($token[1],0,40))){$updatesfound .= '&updates[]='.urlencode($token[0]);unset($token);}
    }
    if (!empty($updatesfound)) { echo N.'<a href="?tools=1&mydata=4'.$updatesfound.'">Update\s available, click here to download and install</a>'.N; }
?>