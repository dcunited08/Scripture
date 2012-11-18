<?php # licence: gpl-signature.txt
$thisyear=date('y',time());
$n=mysql_numrows($s);
if(!empty($nolatest)){$latest='Results in ';}
else{$latest='Latest ';}
if(isset($no_mobile)){$ustyle=' style="text-align:center;display:block;" ';$fsubstr=421;;}//$fdiv2='<div>';$fdiv='</div>';
else{$fsubstr=121;}
$fdiv='<hr>';
$i=0;while($i<$n){
   $snid=mysql_result($s,$i,'nid');$stitle=mysql_result($s,$i,'title');$stype=mysql_result($s,$i,'type');
   $suid=mysql_result($s,$i,'uid');$screated=mysql_result($s,$i,'created');$scate=mysql_result($s,$i,'category');
   $svisitors=mysql_result($s,$i,'visitors');$supcate=mysql_result($s,$i,'uppercat');//$sdata=preg_replace('(\r\n)','<br>',$sdata);
   $sdata=str_replace(array('<br>',"\r\n",'&nbsp;'),'',mysql_result($s,$i,'data'));
   $sdata=preg_replace('/\s{2,10}/',' ',strip_tags($sdata));
   if(strlen($sdata)>$fsubstr){$sdata=substr($sdata,0,$fsubstr);$more='..';}
   elseif(isset($more)){unset($more);}
   if ($stype !== $ttype) {
     //if(!empty($ttype)){echo'</p>';}
     $ttype=$stype;
     $stypet=mysql_result(mysql_query_s('SELECT type FROM '.$database.'.bible_node_types WHERE name=\''.$stype.'\' AND name NOT IN(\'fc\')'),0,'type');
     if($stype == 'cy'){$stypet='Commentaries';}
     elseif(!preg_match('/(^ne$)|(^do$)/i',$stype)){$stypet.='s';}
     echo'<u '.$ustyle.'>'.$latest.$stypet.'</u><hr>';
     if(!isset($no_mobile)){echo N;}
    }
    if(!empty($svisitors)){$sreads=' '.$svisitors.'Reads';}
    elseif(isset($sreads)){unset($sreads);}
    if($thisyear===date('y',$screated)){$datedisp='jM';}else{$datedisp='jMy';}
    echo$fdiv2.'<a href="?forum&nid='.$snid.'&b='.$b.'&s='.$se.'"><img src="ico/'.$stype.'.png">'.
     $stitle.'</a>'.N.preg_replace('/(https?\:[^\s]*(\s|\||$))|(mailto\:[^\s]*(\s|\||$))|(\swww\.[^\s]*(\s|\||$))/i','<a href="\1">Link</a>',$sdata).$more.N.
     '<sup>uid('.$suid.') '.date($datedisp, $screated).$sreads.'</sup>'.$fdiv;
  ++$i;
 }
 //if(!isset($fp)){echo'</div>';}
?>