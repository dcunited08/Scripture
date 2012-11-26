<?php // licence: gpl-signature.txt
    require('Languages/Filter_drupal.php');
    if(isset($_GET['f'])){$tmpfile=stripslashes($_GET['f']);}
    if(isset($_GET['m'])){$mode=stripslashes($_GET['m']);}
    $fh = fopen($tmpfile.'2','a+');
    //ini_set ("display_errors", "1");
    //error_reporting(E_ALL);
    error_reporting(E_ERROR);;
    fwrite($fh, pack('CCC',0xef,0xbb,0xbf));
    $file=file($tmpfile);
    $countfile=count($file);
    $i=0;while($i<=$countfile){
        $ft=explode("\t",$file[$i]);
        $tree=$ft[5];
        if($mode=='2'){$tree=$ft[3];}
        if(!empty($tree)and(strlen($tree)>3)and(substr($ft[0],0,1)!=='#')){
            fwrite($fh,strtoupper($a_shortdrupal[(substr($ft[0],0,2)-1)]).'|'.$ft[1].'|'.$ft[2].'||'.$tree);
        }
        unset($ft);
        //echo (substr($ft[0],0,2)+1)."<br>";
        ++$i;
    }
    fclose($fh);
?>