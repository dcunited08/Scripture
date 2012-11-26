<?php // licence: gpl-signature.txt
    require('Languages/Filter_drupal.php');
    require('Languages/Filter_blueletter.php');
    //ini_set('max_execution_time', '6000');
    //$f_arr2 = file($tmpfile.'2');
    if(isset($_GET['bib'])){$bib=stripslashes($_GET['bib']);}
    else{$bib='KJV';}
    $tmpfile='blueletter'.$bib.'.txt';
    $fh2 = fopen($tmpfile.'2','a+');
    stream_set_timeout($fh2, 20000);
    //ini_set ("display_errors", "1");
    //error_reporting(E_ALL);
    error_reporting(E_ERROR);
    set_time_limit(0);
//if(!ini_get('safe_mode')){set_time_limit(600);} 
    $headers=array('X-EBAY-API-COMPATIBILITY-LEVEL: 507','X-EBAY-API-DEV-NAME: ABCD','X-EBAY-API-APP-NAME: EFGH','X-EBAY-API-CERT-NAME: IJKL','X-EBAY-API-SITEID: 0',);
    //ini_set('max_execution_time', '60');
    
        $tmpfilename='http://m.blb.org';//Bible.cfm?t=KJV&b=Gen&c=1
        $nextu='/bible.cfm?b=Gen&c=1&t='.$bib.'&type=1';
    $itot=0;while($itot<1200){//1200
        $ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $tmpfilename.$nextu);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers to above array
        curl_setopt($ch, CURLOPT_HEADER, true); // Display headers
        //curl_setopt($ch, CURLOPT_VERBOSE, true); // Display communication with server
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 6000);
	$file_contents = curl_exec($ch);
	curl_close($ch);
	if(empty($file_contents)){$file_contents = file_get_contents($tmpfilename);} //if curl is unsupported
        $lines=array();
        if(empty($file_contents)){
            $handle=fopen($tmpfilename, "rb");
            $file_contents=stream_get_contents($handle);
            fclose($handle);
        }
	if(empty($file_contents)){die($tmpfilename.'<br>Error - No data or connection (Some PHP settings might unables(ex. curl)');}
        if(empty($lines[2])){$lines=explode("\n", $file_contents);}
        $countfilel=count($lines);
        if(preg_match('/.(<img border="0" alt="" src="..\/gifs\/nextchapter.gif">)/i',$file_contents,$match)){echo$match[0];}

        $i=0;while($i<=$countfilel){
            if(strstr($lines[$i],'name="1"')){$write='1';}
            if(strstr($lines[$i],'CFForm_2')){unset($write);}
            elseif(isset($write)){
                $writed=preg_replace(array('/(<[^>]*>)/i',"/\r/"),"",$lines[$i]);
                $writed=preg_replace(array('/\s{2,9}/','/\t/'),array("",' '),$writed);
                if(strlen($writed)>11){$writed=preg_replace('/(^\s)/i',"",$writed);fwrite($fh2,$btmp3.'|'.$btmp4.'||'.$writed."\r\n");}
                else{
                  if(preg_match('/\w/',substr($writed,4,11))){
                    if(substr($writed,0,3)!==$btmp){
                        $btmp2=substr($writed,0,3);$btmp=$btmp2;
                        $token=array_search(strtolower($btmp2),$a_blueletter);
                        if($token!==FALSE){$btmp3=strtoupper($a_shortdrupal[$token]);if(isset($breaker)){break;}if($btmp3=='REV'){$breaker='1';}}
                        else{$btmp3=strtoupper($btmp2);}
                    }$btmp4=str_replace(':','|',substr($writed,4,11));
                  }
                }
            }
            if(preg_match('/a\shref\=\"([^\"]*).*nextchapter\.gif/i',$lines[$i],$match)){$nextu=$match[1];}
            ++$i;
        }
        ++$itot;
    }
    fclose($fh2);
?>