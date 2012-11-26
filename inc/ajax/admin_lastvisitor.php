<?php
//<td>'.mysql_result($v2,$i,'visitors_id').'</td>
    //mysql_result($v2,$i,'geodata').'</td><td>'.
    //<td>id</td><td>geo</td>
    if(!isset($_GET['alv'])){$notype=1;}
    if(!isset($password)){$nocount=1;require('../../init.php');}
    if(isset($_GET['lenli'])){$lenli=stripslashes($_GET['lenli']);}
    else{$lenli=100;}
    $visit1=mysql_result(mysql_query('SELECT max(visitors_id) AS C from bible_visitors'),0,'C');
    $v2=mysql_query('SELECT * from bible_visitors where visitors_id between '.($visit1-340).' AND '.$visit1.' Order by visitors_id DESC');
    $nowdel=date('dM ',time());
    $prevhour=mktime(date("H"),date("i")-30,date("s"),date("n"),date("j"),date("Y"));
    $wwwdel=array('http://googleads.g.doubleclick.net/pagead/ads?client=','http://scripture.sourceforge.net/','http://','www.');
    $i=0;while($i<340){//.//'</td><td>'.
        //echo'<tr><td>'.
        $visref=mysql_result($v2,$i,'visitors_referer');
        $visu=mysql_result($v2,$i,'visitors_uid');
        $visipe=mysql_result($v2,$i,'visitors_ip');
        if($visipe!==$visiptmp){$visiptmp=$visipe;}
        elseif(!empty($visipe)){$visipe='↑';}
        else{unset($visipe);}
        if($visu!=='0'){$visudo=$visu;}
        elseif(isset($visudo)){unset($visudo);}
        if(strstr($visref,'http:')){$visref2='http://';}
        elseif(isset($visref2)){unset($visref2);}
        $visref=str_replace($wwwdel,"",$visref);
        $visref=substr($visref,0,$lenli);
        $vistime=mysql_result($v2,$i,'visitors_date_time');
        if($vistime>$prevhour){$bold1='<u>';$bold2='</u>';}
        elseif(isset($bold1)){unset($bold1,$bold2);}
        $vispath=str_replace('/index.php','',mysql_result($v2,$i,'visitors_path')).'?'.mysql_result($v2,$i,'visitors_url');
        if(!empty($visipe)){
            echo $bold1.str_replace($nowdel,'',date('dM H:i',($vistime+(3600*2)))).$bold2.'|'.$visudo.' | '.
            mysql_result($v2,$i,'visitors_title').' | '.$visipe.' | ';
            if($vispath!=='?'){echo'<a href="'.$vispath.'">'.substr($vispath,0,100).'</a> | ';}
            echo$visref;
            if(isset($no_mobile)and isset($_GET['a'])){
                $uagent_=mysql_result($v2,$i,'visitors_user_agent');
                if(!empty($uagent_)){echo' | '.$uagent_.'|'.mysql_result($v2,$i,'lang');}
            }
            //if(isset($no_mobile)){echo'<td>'.mysql_result($v2,$i,'visitors_user_agent').'</td></tr>';}
            //else{echo'</tr>';}
            echo'<br>';
        }
        ++$i;
    }
    //echo'</table>';
    mysql_close($link);unset($username,$password,$database);
?>