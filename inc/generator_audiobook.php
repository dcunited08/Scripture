<?php // licence: gpl-signature.txt
error_reporting(E_ERROR | E_PARSE);
if(!file_exists('audiobible')) { mkdir('audiobible'); }
for($i=1;$i<=66; ++$i) {
    $g=$i;
    require('Languages/Fullnames_eng.php');
    if($gi<10){$gn=$gi;$gi='0'.$gi;}
    $url='http://www.audiotreasure.com/mp3/KJV/'.$gi.'_'.$bo.'/'.$bo.'.m3u';
    if($i==21){$url='http://www.audiotreasure.com/mp3/KJV/21_Ecc/Ecc.m3u';}
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
    curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $file_contents=curl_exec($ch); 
    curl_close($ch);
    print_r(curl_getinfo($ch));
    curl_error($ch);
    if(empty($file_contents)){$file_contents=file_get_contents($url);}
    if(empty($file_contents)){echo N.'Error Generating Audiobible; load inc/generators_audiobook.php on a local machine'.N;}
    else {
      $lines=array();
      $fp=fopen('audiobible/'.$bo.'.m3u','w');
      $lines=explode("\n",$file_contents);
      foreach($lines as $bk){
        if(!preg_match('/^\#/i',$bk)){fwrite($fp,$bk."\n");}
      }
      fclose($fp);
    }
    //echo$i.' '.$lines[0].'<br>';
}
?>