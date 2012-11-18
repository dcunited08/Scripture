<?php // licence: gpl-signature.txt
require('inc/Languages/Filter_english.php');
require('inc/Languages/Filter_drupal.php');
if(!empty($_GET['im'])){$import_mode=$_GET['im'];}
if (empty($whatsite)) { $whatsite = $_GET['sitetoupload']; }
error_reporting(E_ERROR | E_PARSE);
if (($whatsite == 'TSK') && ($uid == '1')) {require('inc/generators_tsk.php');}
elseif ($whatsite == 'bibleworks') {
 $memory_start=memory_get_usage();$time=explode(' ',microtime());$time=$time[1] + $time[0];$time1_res=$time;
 ini_set('max_execution_time', '600'); // increase this?
 require('inc/Languages/Filter_bibleworks.php');
 if (empty($import_mode)) { $import_mode = 'bibleworks'; }
 //if (isset($_GET['s'])) { $separator = $_GET['s']; } //used?
 if (isset($_GET['cs'])) { $chaptersep = $_GET['cs']; }
 //$testfile = $_GET['f'];$import_mode = $_GET['m'];
 if(empty($tmpfile)){$tmpfile=$_GET['file'];}
 $testfile = fopen($tmpfile, 'r');
 $f_arr = file($tmpfile);
 $count = count($f_arr);
 /*$fh = fopen($testfile,'r');
 $count = count($f_arr);*/
 $f_arr2 = file($tmpfile.'2');
 $fh2 = fopen($tmpfile.'2','w');
 if ($import_mode == 'bibleworks') { // not all bibles of bibleworks will be made good yet; but if anyone is interested; here is where you have to tweak. Please commit your improvements in the forum, or on the chat.
 //if ($i > 90) { break; }    //temp
 if (!strpos($f_arr[150], '||')) {$nosep='1';}
 //for($i=0;$i<=$count;$i++) {
 $s='H';if(preg_match('/\d{4}/',$f_arr[0].$f_arr[1])){$strongp='1';}
 fwrite($fh2, pack('CCC',0xef,0xbb,0xbf));
  $i=0;while($i<=$count){
    $a_t_line=explode(' ',str_replace('    ', ' ', $f_arr[$i]));
    $sum=sizeof($a_t_line);
    $bw_namesearch=$a_t_line[0];
            if(strtoupper($bw_namesearch)!=$bw_name){
                $token=array_search(strtolower($bw_namesearch),$a_shortbibleworks);
                if($token!==FALSE){$bw_name=strtoupper($a_shortdrupal[$token]);}
                else{$bw_name=strtoupper($bw_namesearch);}
            }
            $a_t_line[1]=str_replace(':','|',$a_t_line[1]); //$token + 1
            $subset=array_slice($a_t_line,2,$sum); //$token + 2
            $t_linec=$bw_name.'|'.$a_t_line[1].'||'.implode(' ',$subset);
            if(isset($strongp)){
            if(!isset($fnt)){if($bw_name=='MAT'){$s='G';$fnt='1';echo'heyhey';}}
            $t_linec=preg_replace(array('/<0(\d{4})>/','/\(0(\d{4})\)/','/\((\d{3})\)/','/\((\d{4})\)/','/<(\d{1})>/','/<(\d{2})>/','/<(\d{3})>/'),array('<\1>','<\1>','<0\1>','<\1>','<000\1>','<00\1>','<0\1>'),$t_linec);
            $t_linec=preg_replace('/<(\d{4})>/',"<$s".'\1>',$t_linec);
            }
            if(!empty($a_t_line[2])){fwrite($fh2,$t_linec);}
        ++$i;
    }
 }elseif($import_mode=='theword'){
    function utfencoder($teksten) {
    $characterEncoding = mb_detect_encoding($teksten, 'UTF-8, UTF-16, ISO-8859-1, ISO-8859-15, ISO-8859-7, Windows-1252, ASCII');  
    switch ($characterEncoding) {
      case 'UTF-8': break;      
      case 'ISO-8859-1': $teksten = utf8_encode($teksten); break;
      case 'ISO-8859-7': $teksten = utf8_encode($teksten); break;
      default: $teksten = mb_convert_encoding($teksten,'UTF-8',$characterEncoding); break;
    } return $teksten;
    } //<- utf8 encoder
    // /<WT([^>]*)>/  {/1}    matches some coding for language notes <G(\d{3})>
    $basis=file('inc/NT_basis1.txt');$strongp='1';
    $i=0;while($i<=$count){
        $t_linec=utfencoder($f_arr[$i]);
        if(isset($strongp)){
            $t_linec=preg_replace(array('/<WT([^>]*)>/i','/<WG(\d{1})>/i','/<WG(\d{2})>/i','/<WG(\d{3})>/i','/<WG(\d{4})>/i'),array('{\1}','<G000\1>','<G00\1>','<G0\1>','<G\1>'),$t_linec);
            $t_linec=preg_replace('/<(\d{4})>/',"<$s".'\1>',$t_linec);
        }
        fwrite($fh2,str_replace("\r\n","",$basis[$i]).$t_linec);
        ++$i;
    }
 }elseif($import_mode=='tmp'){
 fwrite($fh2, pack('CCC',0xef,0xbb,0xbf)); 
    $i=0;while($i<=$count){
        $t_linec=$f_arr[$i];
        if(!isset($t1)){
            if(preg_match('/^(ACT\|19\|41\|\|)/i',$t_linec)){$t1='1';
            $t_linec=preg_replace('/^(ACT\|19\|41\|\|)/i','ACT|20|1||',$t_linec);$nl='1';}
            fwrite($fh2,$t_linec);
        }else{
            if(isset($nl)){unset($nl);$n5=1;}
            elseif(!isset($n4)){
                $n_=preg_match('/^(\w{2,4}\|\d{1,3}\|\d{1,3}\|\|)/i',$t_linec,$nt);
                $n2=$nt[0];
                echo'<p>'.$n2.' '.$n3.'</p>';
                if(!empty($n3)){fwrite($fh2,str_replace($n3,$n2,$t_linect));$t_linect=$t_linec;}
                $n3=$n2;
            }
            elseif(isset($n5)){$n6='1';unset($n5);}
            elseif(isset($n6)){unset($n4);}
            //else{$n7=1;}
        }
        ++$i;
    }
 }
 else { require('inc/generators_undefined.php'); }
 $time=explode(' ',microtime());$time=$time[1] + $time[0];$time2_res=$time;
 require('inc/benchmark.php');
 $tmpfile = $tmpfile.'2';
} // <- bibleworks
// licence: gpl-signature.txt?>